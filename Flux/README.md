## Flux

This was an internal project used to track incoming data and send it out for fulfillment.  Much like Pteradata, the data
was stored in MongoDB and could be formatted for each recipient.  Beyond that, however, the system had to allow for any
arbitrary data to be stored.  If a landing page asked how many pets you owned, that data had to be stored.  If you had a
choice between five maladies, we had to store that data as well.

## Frameworks

Flux utilizes the Mojavi Framework for it's backend.  It is composed of 3 components
- **admin** - main backend for managing leads, networks, fulfillment, and reporting
- **api** - api connection to the database
- **fe** - frontend tracking used for tracking clicks, opens, and page tracking

I use **bower**, **gulp**, and **npm** to install all the javascript and css.  Gulp uses bower-main-files to make including the
javascript files easier.

Flux uses jQuery for page interaction.  It also uses a helper class that I wrote called $.rad that
abstracts form submission, ajax calls, and notifications.

## Backend

Flux uses **MongoDB** for it's backend database.  Within the database, I use capped collections, ttl indexes, the
aggregate framework, and sub documents.

The main record collection has dynamic fields to support the data fields.

## PHP Innovations

### Collection Classes

Each collection in MongoDB has 3 files.  For instance, if there was a collection called User, there would be:
- `Flux\User.php` - Main class containing helper functions such as `changePassword()` and `sendWelcomeEmail()`
- `Flux\Base\User.php` - Base class built with fluent getters/setters that match the collection such as `getName`/`setName`
and `getEmail`/`setEmail`
- `Flux\Link\User.php` - Linking class to use when a user object needs to be associated with another collection.  This
class stores the ObjectId, name, and other data that needs to be copied.  It also has a public function - `getUser()` -
that provides access to the full user object.  This way, when a record is serialized, it doesn't need to store the entire
user object, but can still store enough information that joins are not necessary.

### Data Fields

This system has a collection called data_field.  A data field is a definition for any data that needs to be collected.
The data field defines the collection key, alternate query string names, and where the data should be stored.  For instance,
the `First Name` data field is stored in the `_d` (data sub document) within a lead.  It is stored with the key `fn` but it
can be populated with the query string parameters `fname`, `first`, `name`, and `firstname`.

### Daemons

This system employs several PHP daemons that run on a while loop.  Each daemon can be used to monitor a collection and
process the records within it.  If the collection is empty, the daemon enters a sleep state so it is not churning CPU
cycles.  Each daemon can be started from the command line and will spawn multiple child threads, allowing for efficiency
and speed.

### CORS REST

Since this project uses an API layer, I employ **CORS** to make form submissions easier.  A form can submit to a normal url
and, using the $.rad.form() helper, I can intercept the form submission and submit it to the api url.  The
helper has full form support with GET, POST, PUT, and DELETE.  It also can support file uploads, asynchronous submits,
validation and notifications.

### Updates

The code can be updated using YUM.  There is page that can check for updates and update the codebase directly from the
site.  This has to use sudo on the backend to run the update, and this is accomplished through a bash script that has
privileges via sudoers.

## Slickgrid

Most of the pages that display tabular data use a modified [Slickgrid](https://github.com/mleibman/SlickGrid) to display the data.  Slickgrid is a Javascript
Grid, similar to DataTables.  It's strength comes from a view I built that allows for backend pagination and caching.

Using an ajax call, I pull down the first 500 records and cache them.  I also calculate the total number of records (for
instance, there are about 90,000 links).  Using this data, I can display the first page of data (25 records) and the user
can browse page to page up to the first 500.  Once the user requests record #501, an additional ajax call is submitted to
download and cache records 501-1000.  If a user jumps to the last page, an ajax call is made to cache the last 500 records.

This innovative approach allows the grid to easily handle millions of records with almost no lag.  Additionally, using the
caching mechanism reduces the need to make ajax calls on every page request.

## Selectize

All the select boxes are stylized using the [Selectize](http://selectize.github.io/selectize.js/) plugin.  This allows for searching, custom rendering, and allows
them to be displayed similar to other form-control bootstrap styled elements.

## Bootstrap

The Admin interface use a custom theme on top of [Bootstrap](http://www.getbootstrap.com/).