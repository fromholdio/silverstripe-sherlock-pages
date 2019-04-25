<div id="Content" class="searchResults">
    <h1>$Title</h1>

    $SearchForm

    <% if $SearchPhrase %>
        <p class="searchQuery">You searched for &quot;{$SearchPhrase}&quot;</p>

        <% if $SearchResults %>
            <ul id="SearchResults">
                <% loop $Results %>
                    <li>
                        <h4>
                            <a href="$Link">
                                <% if $MenuTitle %>
                                    $MenuTitle
                                <% else %>
                                    $Title
                                <% end_if %>
                            </a>
                        </h4>
                        <% if $Content %>
                            <p>$Content.LimitWordCountXML</p>
                        <% end_if %>
                        <a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
                    </li>
                <% end_loop %>
            </ul>
        <% else %>
            <p>Sorry, your search query did not return any results.</p>
        <% end_if %>

    <% end_if %>


</div>
