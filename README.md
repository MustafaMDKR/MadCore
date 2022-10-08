# MadCore

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