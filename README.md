# _Shoe Store Manager_

#### _Allows the user to list out local shoe stores and the brands they carry, 9/30/16_

#### By _**Ryan Loos**_


## Setup/Installation Requirements

* _Clone this repository to your desktop_
* _Run composer install in Terminal_
* _start a server in web directory (php -S localhost:8000)_
* _download the database file and use it to start an apache server_

## Database instructions
* _CREATE DATABASE shoes;_
* _USE shoes;_
* _CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));_
* _CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));_
* _CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);_

## Behavior Driven Development

Behavior | input | output
| Create a Store category and save the individual instance to the database | "Nordstrom" | "Nordstrom" |
| Create functionality that list all Stores | click | "Nordstrom","Payless" |
| Create functionality that deletes all Stores | click | "" |
| Be able to locate a Store by a unique ID | 1 | "Nordstrom" |
| Update a Store's information in the system | "Nordstrom" | "Nordstrom Rack" |
| Delete a Store in the system | "Nordstrom" | "" |
| Create a Brand category and save the individual instance to the database | "Nike" | "Nike" |
| Create functionality that list all Brands | click | "Nike","Adidas" |
| Create functionality that deletes all Brands | click | "" |
| Be able to locate a Brand by a unique ID | 1 | "Nike" |
| Be able to add a brand to a store| "Nike": "Nordstrom"| "Nike": "Nordstrom" |
| Be able to delete a brand from a store| "Nike","Adidas": "Nordstrom"| "Nike": "Nordstrom" |
| Create a function that allows a user to list all the Brands in a store | "Nordstrom"| "Nike","Adidas"|
| Be able to add a store to a brand| "Nordstrom": "Nike" | "Nordstrom": "Nike" |
| Be able to delete a store from a brand| "Nordstrom", "Payless": "Nike"| "Nordstrom": "Nike" |
| Create a function that allows a user to list all the Stores that carry a certain brand | "Nike"| "Nordstrom","Payless"|


## Known Bugs

_None yet_

## Support and contact details

_Ryan Loos: Rloos289@gmail.com_

## Technologies Used

_HTML,
PHP,
TWIG 1.0,
SILEX 1.1_

### License

*This webpage is licensed under the GPL license.*

Copyright (c) 2016 **_Ryan Loos_**
