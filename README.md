# Carthook assignment

### HTTP library

I was using Laravel HTTP client (which is an expressive wrapper around the Guzzle HTTP library)
to perform various API calls. All of the client (Guzzle) options are set in its class
which is bound to the app IOC container. The options themselves are placed in a config file
which can be overridden by values in `.env` file. The only option, for now, is endpoint though. 

### Caching API calls

All API data are stored in the local database which can be updated with `api:sync` artisan command.
Various synchronization tasks like fetching users, posts and comments are split into steps 
and separated into different classes from that command. It's also possible to specify how many first resources to fetch. 
This command is executed every hour if scheduler is set up properly. The command executes for roughly 1.1 seconds 
on my machine so I guess one hour is pretty fair. It should be tweaked based on the data update frequency requirement. 
This approach can be contested but there are some advantages:

- The data will be delivered fast to every single end-user.
- The internal API won't stop working even though the external one will. Only the data will be not up to date.

### Testing

The entire application is tested. I was following the Test-Driven Development approach. Almost all of the API calls
are faked using Laravel `HTTP` facade capabilities to not waste time and resources during every test. But the real
API calls are also tested to be sure that the real API is working and the structure of response has not been changed.
If it's needed to execute the full test suite and not hit the real API we can specify to exclude api group like so:
`--exclude-group api`. The local API endpoints are also tested. In memory sqlite database was using during tests 
for the sake of simplicity.

### Database design

The database has been developed so it has the same relationships between resources as in the external API. 
Some indexes are also added to improve the queries speed.

### Potential improvements 

I would consider to cache local results in some in-memory database like Redis to achieve less server response time
and reduce the MySQL database load.
