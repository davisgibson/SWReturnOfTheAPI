@extends('layouts.app')

@section('content')
<div class="card card-body" style="background-color: rgba(234, 235, 242, 0.9)">
	<input type="text" class="form-control col-12" id="search" placeholder="Search..." autocomplete="off">
 	<div class="form-check mb-2 mt-3">
    	<input type="checkbox" class="form-check-input" id="onlyShowFavorites" value="1">
    	<label class="form-check-label" for="onlyShowFavorites">Only Show Favorites</label>
  	</div>
  	<p class="d-none" style="opacity: 0.5; text-size: 0.8em" id="favoritesEnabledNote">See README to learn why search doesn't work with favorites</p>
  	<hr>
  	<div class="d-none card searchResult text-center py-4 mb-3" id="searchResultTemplate">
  		<i class="fa-solid fa-user fa-5x my-3"></i>
  		<h3 class="searchResultTitle"></h3>
  		<div class="searchResultDetails">
  			<span class="searchResultDetail searchResultGender"></span>
  			<span class="searchResultDetail searchResultHairColor"></span>
  			<span class="searchResultDetail searchResultHeight"></span>
  			<span class="searchResultDetail searchResultBirthday"></span>
  		</div>
  	</div>
  	<span class="loader mx-auto d-none">Loading... (Star Wars API is slow)</span>
  	<span class="mx-auto d-none" id="emptyResults" style="opacity: 0.8">Nothing found. Try changing the search query.</span>
  	<div id="resultsContainer" class="w-100">

  	</div>
</div>
@endsection

@push('scriptstack')
<script>
	getSearchResults();
	// allow two second delay before fetching search results.
	var _changeInterval = null;
	$('#search').on("keyup", function(e) {
		clearInterval(_changeInterval)
	    _changeInterval = setInterval(function() {
	        clearInterval(_changeInterval)
	        getSearchResults();
	    }, 2000);
	});

	$('#onlyShowFavorites').change(function() {
		if($(this).is(':checked'))
		{
			$('#search').prop('disabled', true);
			$('#favoritesEnabledNote').removeClass('d-none');
		}
		else
		{
			$('#favoritesEnabledNote').addClass('d-none');
			$('#search').prop('disabled', false);
		}

		getSearchResults();
	});

	function getSearchResults()
	{	
		$('#emptyResults').addClass('d-none');
		$('#resultsContainer').empty();
		$('.loader').removeClass('d-none');
		$.ajax({
			method: "GET",
			url: "/search",
			data: {
				q: $('#search').val(),
				onlyShowFavorites: $('#onlyShowFavorites').is(':checked'),
			},
			success: function(response){
		    	parseResults(response);
		  	}
		});
	}

	function parseResults(results)
	{       
		$('#resultsContainer').empty();
		console.log(results);
		if(!results || results.length == 0)
			$('#emptyResults').removeClass('d-none');
		$.each(results, function(i, result) {
			var template = $('#searchResultTemplate').clone();
			template.find('.searchResultTitle').text(result.name);
			template.find('.searchResultBirthday').text('born ' + result.birth_year);
			template.find('.searchResultGender').text(result.gender);
			template.find('.searchResultHeight').text(result.height + ' inches');
			template.find('.searchResultHairColor').text('hair: ' + result.hair_color);
			template.attr('data-url', result.url);
			if(result.isFavorite)
				template.attr('data-is-favorite', 'true');
			template.removeClass('d-none');
			template.removeAttr('id');

			$('#resultsContainer').append(template);
		});

		$('.searchResult').click(function(event) {
			var url = $(this).data('url');
			var isFavoriteAlready = $(this).data('is-favorite');
			$(this).attr('data-is-favorite', !isFavoriteAlready);
			if(isFavoriteAlready && $('#onlyShowFavorites').is(':checked'))
				$(this).remove();
			$.ajax({
				method: "POST",
				url: "/favorite",
				data: {
					url: url,
					_token: "{{ csrf_token() }}",
				},
			});
		});

		$('.loader').addClass('d-none');
	}
</script>
@endpush