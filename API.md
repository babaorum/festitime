FORMAT: 1A
HOST: http://festitime.dev:8080

# FESTITIME API
Festitime is a Student project for an ecommerce website.
The particularity of this website is to be specific to Festivals.
We really think Festival is a particular type of buisness and that really specific features can be developed for it.

Here is the documentation of our **REST API** written in the **API Blueprint**. 

## Festival [/festival/{id}]
This resource represents one particular festival identified by its *id*.

+ Parameters
    + id (string) ... ID of the festival

+ Model (application/json)

    JSON representation of festivals.

    + Body

        {
        "id": "1",
        "name": "Sziget Festival",
        "description": "le sziget festival est un festival de musique diverses.",
        "type": [
            "jazz",
            "electro",
            "rock",
            "pop",
            "reggae",
            "metal",
            "punk"
        ],
        "img": "http://www.funzine.hu/wp-content/uploads/2009/07/Sziget19.jpg",
        "start_date": "2015-08-10T00:00:00+0200",
        "end_date": "2015-08-17T00:00:00+0200",
        "city": "Budapest",
        "country": "Hongrie",
        "price": 300
        }

### Retrieve Festival [GET]
Retrieve a festival by its *id*.

+ Response 200
    
    [Festival][]

### Edit A Festival [PUT]
Updates A Festival

+ Request (application/json)

        {
        "id": "1",
        "name": "Sziget Festival",
        "description": "le sziget festival est un festival de musique diverses.",
        "type": [
            "jazz",
            "electro",
            "rock",
            "pop",
            "reggae",
            "metal",
            "punk"
        ],
        "img": "http://www.funzine.hu/wp-content/uploads/2009/07/Sziget19.jpg",
        "start_date": "2015-08-10T00:00:00+0200",
        "end_date": "2015-08-17T00:00:00+0200",
        "city": "Budapest",
        "country": "Hongrie",
        "price": 300
        }

+ Response 200

    [Festival][]

### Delete A Product [DELETE]
+ Response 204

## Festivals Collection [/festivals{?q}]
Provides access to all festivals.

+ Model (application/json)
    
    JSON representation of festivals.

    + Body

        {
        "id": "1",
        "name": "Sziget Festival",
        "description": "le sziget festival est un festival de musique diverses.",
        "type": [
            "jazz",
            "electro",
            "rock",
            "pop",
            "reggae",
            "metal",
            "punk"
        ],
        "img": "http://www.funzine.hu/wp-content/uploads/2009/07/Sziget19.jpg",
        "start_date": "2015-08-10T00:00:00+0200",
        "end_date": "2015-08-17T00:00:00+0200",
        "city": "Budapest",
        "country": "Hongrie",
        "price": 300
        }

### List All Festivals [GET]
+ Parameters
    + q (optional, string) ... Keyword query to search for festivals

+ Response 200

    [Festivals Collection]

### Create A Festivals [POST]
Allows the creation of a new festival.

+ Request (application/json)

        {
        "id": "1",
        "name": "Sziget Festival",
        "description": "le sziget festival est un festival de musique diverses.",
        "type": [
            "jazz",
            "electro",
            "rock",
            "pop",
            "reggae",
            "metal",
            "punk"
        ],
        "img": "http://www.funzine.hu/wp-content/uploads/2009/07/Sziget19.jpg",
        "start_date": "2015-08-10T00:00:00+0200",
        "end_date": "2015-08-17T00:00:00+0200",
        "city": "Budapest",
        "country": "Hongrie",
        "price": 300
        }

+ Response 201

    [Festival][]
