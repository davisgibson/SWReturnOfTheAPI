Thank you for viewing my project.

This should be a standard laravel installation. I used docker and sail.

feel free to run `php artisan test` from project root to run tests.
(you may have to edit .env.testing and make a new database/migrate)

Here is the TODO (if I had time):

1. proper error handling (front and back-end)
2. fix bugs relating to multiple api calls in quick succession
3. cleaner look for favorited items
4. move scripts/styles to proper asset handling
5. put more care into result details (n/a might look bad)
6. caching
7. make the UI more colorful. add some triadic colors because we like to have fun around here
8. some sort of confirmation that changes have been saved successfully
9. more thorough testing
10. use an api that's faster and has better querying capabilities



Here I'd like to explain a few of the decisions I made while building this:


Requirements such as "The user should be able to name their list whatever they want" 
and "Choosing an item from the list should erase the search results and show only what they saved in that list"
were not implemented due to time constraints.



Unfortunately, Star Wars API doesn't return an ID with results. That means storing favorites will be by URL, which is not ideal, but better than nothing. 
Technically the URL contains the object's ID, but cutting that string down to the bare ID feels too much like duct-tape and WD-40.



I think this application would be well-suited for Vue, but in the scope of a four hour project, I can personally do more with blade and jQuery.



Star Wars API (SWAPI) is very slow. Not only that, they limit to 10 results per page. Thankfully they include pagination with a "next" url. 
If I had more time with this project, I would implement infinite scrolling using that url.



If I had more time I would set up proper stylesheets/js asset handling with vite or webpack. I don't like to write styles in the HTML header, but for this case that was not a priority.



SWAPI doesn't accept a query other than a search term, so querying by favorites is not an option. that means we have to label favorites *after* the API call is returned.
if SWAPI returned more than 10 items per page, mapping through the results as we are would not be a great idea.



Possibly the most critical flaw of this project:
"only show favorites" does not work with a search query. This is due to a combination of SWAPI limiting their results and not allowing queries other than by name.
If this were a real project, I would have restarted with a better API.



Thanks again

-- Davis Gibson