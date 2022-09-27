
Remove {{ collection.description }} or commnent it out like this: {% comment %}{{ collection.description }} {% endcomment %}

THen add the following code to the liquid files where you want the scription to be shown. 

{% assign descriptions = collection.description | split: "<!-- split -->" %}
{% assign short_desc = descriptions[0] %}
{% assign long_desc = descriptions[1] %}

In the collection / category descirption, switch to HTML mode and insert <!-- split --> where you want the category to split.
Example: main-collection-product-grid.liquid
