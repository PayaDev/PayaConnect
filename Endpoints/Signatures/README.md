# Signatures Endpoint
## Overview
| Methods | POST, GET                                      |
|---------|------------------------------------------------|
| Filters | created_ts, modified_ts, resource, resource_id |
| Expands | --                                             |
 

For GET requests:

**Filters can be used** to search for Terminals by including the columns you want to filter on as URL parameters.
i.e. `/v2/signatures?field=value&field2=value2`
 

## Fields
| Name        | Type/Format | Length | Default          | Comments                                                                             |
|-------------|-------------|--------|------------------|--------------------------------------------------------------------------------------|
| id          | string      | 36     | System Generated | ID                                                                                   |
| resource_id | string      | 36     |                  | Resource ID - Id of the resource associated with the signature (i.e. Transaction id) |
| resource    | string      |        |                  | Resource Name - Possible values are: AccountVault, Transaction, Recurring            |
| signature   | string      |        |                  | Base64 encoded version of the image file                                             |
|             |             |        |                  |                                                                                      |
| created_ts  | number      | 10     | System Generated | Created Timestamp                                                                    |
| modified_ts | number      | 10     | System Generated | Modified Timestamp                                                                   |

 

## Actions
### Create Record
`POST /v2/signatures`

Request
```json
{
    "signature": {
        // All 3 fields illustrated here are REQUIRED
        "resource_id": "{{keyed_cc_transaction_id5}}",
        "resource": "Transaction",
        "signature": "iVBORw0KGgoAAAANSUhEUgAAANwAAAAsCAYAAAAOyNaYAAACvklEQVR4nO3bLZOqUBjA8ScaNxqNRiKRaCQaiXwEG7cRiUajH8FINBqJRCKR+NxyD4OIXtaXw2H3/5s5MwZ39rgz/zkvuKKqgar+YTAYnx/y7wUACwgOsIjgAIsIznFlWerlcpl6GngTgnNYVVW6WCxURDTLsqmngzcgOMdtNhsVERURDYJA8zyfekp4AcE5oCgKzfN8cOvYNM1VdCKiURRNMEu8A8FNrCzLm5j68Q1Fx2o3TwTngCzLNAiCq6D6UTVNo0mS6NfXF+HNGME5or+KeZ7XxrVcLjWOY83zXOu6vnqfeQ/bzHkgOIf0VzHP83Sz2eh6vW4D831fy7JsowvDsH1NdO4jOAfVdX0VXhRFWhSFRlHUrmr7/b4NLU3T9jVbTLcRnMO620ezep1Op3bF832/3XIORQr3EJzjumc7E9HQBUoYhjdnPKJzD8E5xjyT647T6aSr1UpFRPf7ffveuq41TdOHZzyicwvBTeBeVGEY3jwaGBrmWV3/Z82K1z/jca5zB8F9wFBQY6JaLBYax7EmSXJ3DD2v624rzUpoVrsgCDjXOWRWwVVVNfUUrvTDGrNK3YsqTdNRn69pGs2y7NshssV0w2yCK4pCRUSPx+Okc/hfWI9WqbFRPaMbYjc+s7ptt1uic8BsgsvzXEVED4fDR3/P2PPVUFifDOo7THxmPiY03/fZXk7s1wR371z1zPnKlbDGuvc9TKKz78cE9yio3W436vbv1fOV6/oPx010/Ee5PbMLbrfbPRWU53kPb/9+SlRj9L8ALcJ/lNsym+DO5/PTQaVpqnVdT/0RnGLOed0LlikvpH6L2QSnqoPX4QT1mu4FC3/Dz5tVcMDcERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGDRX+EC0ah++pNrAAAAAElFTkSuQmCC"
    }
}

```

Response
```json
{
    "signature": {
        "id": "552e1e68-495c-beb0-fdb7-048a30998a44",
        "resource_id": "552e1e68-4440-6f05-fdb7-6cbc61750767",
        "resource": "Transaction",
        "signature": "iVBORw0KGgoAAAANSUhEUgAAANwAAAAsCAYAAAAOyNaYAAACvklEQVR4nO3bLZOqUBjA8ScaNxqNRiKRaCQaiXwEG7cRiUajH8FINBqJRCKR+NxyD4OIXtaXw2H3/5s5MwZ39rgz/zkvuKKqgar+YTAYnx/y7wUACwgOsIjgAIsIznFlWerlcpl6GngTgnNYVVW6WCxURDTLsqmngzcgOMdtNhsVERURDYJA8zyfekp4AcE5oCgKzfN8cOvYNM1VdCKiURRNMEu8A8FNrCzLm5j68Q1Fx2o3TwTngCzLNAiCq6D6UTVNo0mS6NfXF+HNGME5or+KeZ7XxrVcLjWOY83zXOu6vnqfeQ/bzHkgOIf0VzHP83Sz2eh6vW4D831fy7JsowvDsH1NdO4jOAfVdX0VXhRFWhSFRlHUrmr7/b4NLU3T9jVbTLcRnMO620ezep1Op3bF832/3XIORQr3EJzjumc7E9HQBUoYhjdnPKJzD8E5xjyT647T6aSr1UpFRPf7ffveuq41TdOHZzyicwvBTeBeVGEY3jwaGBrmWV3/Z82K1z/jca5zB8F9wFBQY6JaLBYax7EmSXJ3DD2v624rzUpoVrsgCDjXOWRWwVVVNfUUrvTDGrNK3YsqTdNRn69pGs2y7NshssV0w2yCK4pCRUSPx+Okc/hfWI9WqbFRPaMbYjc+s7ptt1uic8BsgsvzXEVED4fDR3/P2PPVUFifDOo7THxmPiY03/fZXk7s1wR371z1zPnKlbDGuvc9TKKz78cE9yio3W436vbv1fOV6/oPx010/Ee5PbMLbrfbPRWU53kPb/9+SlRj9L8ALcJ/lNsym+DO5/PTQaVpqnVdT/0RnGLOed0LlikvpH6L2QSnqoPX4QT1mu4FC3/Dz5tVcMDcERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGDRX+EC0ah++pNrAAAAAElFTkSuQmCC",
        "created_ts": 1429118281,
        "modified_ts": 1429118281,
        "_links": {
            "self": {
                "href": "https://sandbox.domain.com/v2/signatures/{id}"
            }
        }
    }
}
```

### View Single Record
`GET /v2/signatures/{id}`

Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
{
    "signature": {
        "id": "552e1e68-495c-beb0-fdb7-048a30998a44",
        "resource_id": "552e1e68-4440-6f05-fdb7-6cbc61750767",
        "resource": "Transaction",
        "signature": "iVBORw0KGgoAAAANSUhEUgAAANwAAAAsCAYAAAAOyNaYAAACvklEQVR4nO3bLZOqUBjA8ScaNxqNRiKRaCQaiXwEG7cRiUajH8FINBqJRCKR+NxyD4OIXtaXw2H3/5s5MwZ39rgz/zkvuKKqgar+YTAYnx/y7wUACwgOsIjgAIsIznFlWerlcpl6GngTgnNYVVW6WCxURDTLsqmngzcgOMdtNhsVERURDYJA8zyfekp4AcE5oCgKzfN8cOvYNM1VdCKiURRNMEu8A8FNrCzLm5j68Q1Fx2o3TwTngCzLNAiCq6D6UTVNo0mS6NfXF+HNGME5or+KeZ7XxrVcLjWOY83zXOu6vnqfeQ/bzHkgOIf0VzHP83Sz2eh6vW4D831fy7JsowvDsH1NdO4jOAfVdX0VXhRFWhSFRlHUrmr7/b4NLU3T9jVbTLcRnMO620ezep1Op3bF832/3XIORQr3EJzjumc7E9HQBUoYhjdnPKJzD8E5xjyT647T6aSr1UpFRPf7ffveuq41TdOHZzyicwvBTeBeVGEY3jwaGBrmWV3/Z82K1z/jca5zB8F9wFBQY6JaLBYax7EmSXJ3DD2v624rzUpoVrsgCDjXOWRWwVVVNfUUrvTDGrNK3YsqTdNRn69pGs2y7NshssV0w2yCK4pCRUSPx+Okc/hfWI9WqbFRPaMbYjc+s7ptt1uic8BsgsvzXEVED4fDR3/P2PPVUFifDOo7THxmPiY03/fZXk7s1wR371z1zPnKlbDGuvc9TKKz78cE9yio3W436vbv1fOV6/oPx010/Ee5PbMLbrfbPRWU53kPb/9+SlRj9L8ALcJ/lNsym+DO5/PTQaVpqnVdT/0RnGLOed0LlikvpH6L2QSnqoPX4QT1mu4FC3/Dz5tVcMDcERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGARwQEWERxgEcEBFhEcYBHBARYRHGDRX+EC0ah++pNrAAAAAElFTkSuQmCC",
        "created_ts": 1429118281,
        "modified_ts": 1429118281,
        "_links": {
            "self": {
                "href": "https://sandbox.domain.com/v2/signatures/{id}"
            }
        }
    }
}
```

### View Record List
`GET /v2/signatures`
Request
```json
{
    // Empty Payload - Nothing Needed Here
}
```

Response
```json
{
  "signatures": [
    {
      "id": "552eb72f-470e-8267-a598-bc15bbb1cd67",
      "resource_id": "552e0d76-b61b-0d42-dd77-9c879e1abdd7",
      "resource": "Transaction",
      "signature": "iVBORw0KGgoAAAANSUhEUgAAANwAAA...",
      "created_ts": 1429116487,
      "modified_ts": 1429116487,
      "_links": {
        "self": {
          "href": "https://sandbox.domain.com/v2/signatures/{id}"
        }
      }
    },
    {
      "id": "552e9bcf-9379-b9d0-af8b-5c6be6b7c23c",
      "resource_id": "552ea6e0-c7cd-9894-f1e5-ffb29e5064b6",
      "resource": "Transaction",
      "signature": "iVBORw0KGgoAAAANSUhEUgAAANw...",
      "created_ts": 1429109139,
      "modified_ts": 1429109139,
      "_links": {
        "self": {
          "href": "https://sandbox.domain.com/v2/signatures/{id}"
        }
      }
    }
  ],
  "meta": {
    "pagination": { ... },
    "sort": {
      "attributes": {
        "id": "desc"
      }
    }
  }
}
```
