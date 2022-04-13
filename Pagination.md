# Pagination and Sorting
Many of the endpoints will return only a limited of number of records, however it is often possible to paginate through these results by using the following URL parameters: `sort`, `page`, and `page_size`.

## Pagination
You can determine whether your results are paginated by looking for the `meta[pagination]` field within the response.

Looking at the JSON example below we can see that within the pagination object there are 4 fields that provide the necessary information to paginate through the results.

```json
{
  "accountvaults": [
    ... // Account Vault Objects 
  ],
  "meta": {
    "pagination": {
      "links": {
        "self": {
          "href": "https://{domain}/v2/accountvaults?page_size=10&page=1"
        }
      },
      "totalCount": 100, // #1 The total number of records available.
      "perPage": 10, // #2 How many records to include per "page"
      "pageCount": 10, // #3 Number of Pages needed to display all records based on perPage
      "currentPage": 1 // #4 The current page number being returned.
    },
    "sort": {
      "attributes": {
        "created_ts": "desc" // The field used to sort by with the direction as value
      }
    }
  }
}
```
Example 1: Showing the 3rd page of Account Vaults for a location, showing 10 per page :

> GET /v2/accountvaults/?page_size=10&page=3

Example 2: Showing the 5th page of Account Vaults for a location, showing 20 per page :

> GET /v2/accountvaults/?page_size=20&page=5

## Sorting
Most result sets can be sorted, and have a default sort. You can determine how your results are being sorted by looking for the `meta[sort]` field within the response.

Looking at the JSON example above we can see that within meta[sort][attributes] you will find a field name with a corresponding value of either "asc" or "desc".

To sort by a specific field you can add sort={field_name} to the URL for the GET request like so:

> GET /v2/accountvaults/?sort=created_ts

To sort descending, add a "-" in front of the field name like so:

> GET /v2/accountvaults/?sort=-created_ts

This last method is a great way to return the most recent records first!

## Putting it all together

To retrieve the 2nd page (10 records per page) of the ***most recent*** Account Vaults:

> GET /v2/accountvaults/?sort=-created_ts&page_size=10&page=2

To retrieve the 2nd page (10 records per page) of the ***oldest*** Account Vaults:

>GET /v2/accountvaults/?sort=created_ts&page_size=10&page=2
