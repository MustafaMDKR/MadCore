# MadCore

## Router
A class and interface which manage routing in our framework

## DatabaseConnection
Creating a database interface and class to open & close a connection to our database.

## LiquidOrm
Got 4 layers to interact with data and queries:

    ### DataMapper
We now got our DatMapper which wraps around PDO methods
and provide us with a lyer which access the database
it got a factory pattern which create an object of that dataMapper class
and that inject the required object that it need 
(The required object is the databaseConnection)

    ### QueryBuilder
this is basicly helping us to keep this simple queries in a class 
which we can reference without rewriting queries sothat if we need 
to make changes we can make changes in one place without effecting our queries.

    ### EntityManager
This is the layer which interacts directly with our database.
So it got the Crud class in it that does all the CRUD operations 

    ### Data Repository layer
This layer contains the methods which organise dealing with finding a specific data 
from our database

## Session
Here we have session interface , session class, session factory,session storage interface, Native & Abstract session storage class. 

## BaseClasses
Provided 3 base classes 
    - BaseController
    - BaseModel
    - BaseView

## GlobalManger Component
A component to deal with the array of globals

## Traits
A basic system trait component to be expanded later to deal with multiple inheritance

## Flash
A component for dealing with flash messages within the session component

## Http Handler
A component to deal with Request and Response extended from Symfony HTTP Foundation

## Error Handler
A component to control the display of errors to our users and also for developers by
converting all errors to exceptions by throwing an ErrorException.


