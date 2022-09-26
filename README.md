# MadCore

## LiquidOrm

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

### Going on with the Repository layer
