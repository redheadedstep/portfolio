## RAD Mailing Platform

The RAD Mailing Platform was designed by myself back in 2008 as a mass mailing platform.  It can be deployed to a
centralized API/Admin server and can have dozens of mailers communicating with it.  Each mailer is capable of downloading
data lists, rotating available IPs, and harvesting bounce and deliverable files.  The platform is fully automated and
can handle millions of IP addresses and billions of pieces of mail.

## Frameworks

RAD utilizes an older version of the Mojavi Framework for it's backend.  It is composed of 5 components
- **admin** - main backend for managing servers, ips, networks and offers, and reporting
- **api** - api connection to the database
- **cli** - installed on mail server and is responsible for sending out the mail
- **track** - tracking web server for tracking clicks and opens

RAD uses jQuery for page interaction.  It also uses a helper class that I wrote called $.rad that
abstracts form submission, ajax calls, and notifications.

## Backend

RAD uses MySQL for it's backend database.  The database can scale from a single server to Multi-Master Replication.  The
tables use the `InnoDB` engine (while temporary tables use `MyISAM` for speed).

The track component creates a new table each day automatically, so the user doesn't have to worry about table bloat over
time.

All the indices on the tables have been fine-tuned and allow for the greatest speed.  Even large queries can run quickly
across millions of records.

## Bash

The List management aspect and Mailing both use extensive bash scripts for speed.  Instead of running a dedupe within the
database and consuming CPU cycles, I use bash commands such as `comm`, `sort`, and `uniq`.

Running these linux commands require that they exist on the server, and so research had to be done to discover which
yum packages needed to be installed.  Once installed, variations in commands had to be considered due to different
Linux distributions and versions.  For instance, on CentOS 6.8 and under, network interfaces are prefixed with `eth`, while
on CentOS 7 and greater, they are prefixed with `em`.

## PHP Innovations

### Form and Model Classes

Each table in MySQL has 4 files.  For instance, if there was a collection called User, there would be:
- `DaoOffer\Forms\base\User.php` - Base class built with fluent getters/setters that match the collection such as `getName`/`setName`
and `getEmail`/`setEmail`.  This class can be deleted and re-generated as new columns are added to the table.
- `DaoOffer\Forms\User.php` - Main class containing helper functions such as `changePassword()` and `sendWelcomeEmail()`.  A Form is
a representation of a single row in the table.
- `DaoOffer\Models\base\User.php` - Base class containing all the base queries to interact with the database.  A model is a representation of the
entire table and contains functions such as `performQuery`, `performUpdate`, `performQueryAll`, and `performDelete`.  This class
can be deleted and re-generated as new columns are added to the table.
- `DaoOffer\Models\User.php` - Class containing all the business logic used to interact with the database.  For instance, it may
contain `performLogin` or `performResetPassword`.

### Reflection

All the Form classes extends a BaseForm that has a populate method.  It uses the PHP Reflection class to inspect a class
and match array keys (for instance from the $_POST array) to functions within the class.  This allows the programmer to
write code like this:

```php
// Url is /account/user?id=123
$form = new DaoOffer\Form\User();
$form->populate($_POST);
echo $form->getId();
$form->query(); // internally calls $form->getModel()->performQuery($this);
echo $form->getName();
echo $form->getEmail();
```

### REST

Since this project uses an API layer, I employ **REST** on the API layer to handle requests.  When adding a record, I
use the POST verb.  When querying one or more records, I use the GET verb.  To update an existing record, the PUT verb
is used, and to delete a record, the DELETE verb is used.  This is easily done within the HTML markup.

```html
<form method="POST" action="/api">
  <input type="hidden" name="func" value="/account/user" />
  <input type="text" name="username" value="" />
  <input type="text" name="email" value="" />
  <input type="submit" name="submit" value="add user" />
</form>

<form method="PUT" action="/api">
  <input type="hidden" name="func" value="/account/user" />
  <input type="hidden" name="id" value="123" />
  <input type="text" name="username" value="" />
  <input type="text" name="email" value="" />
  <input type="submit" name="submit" value="update user" />
</form>

<form method="DELETE" action="/api">
  <input type="hidden" name="func" value="/account/user" />
  <input type="hidden" name="id" value="123" />
  <input type="submit" name="submit" value="delete user" />
</form>

<form method="GET" action="/api">
  <input type="hidden" name="func" value="/account/user" />
  <label>Enter email to search for: <input type="text" name="email" value="" /></label>
  <input type="submit" name="submit" value="find users" />
</form>
```

### Updates

The code can be updated using YUM.  There is page that can check for updates and update the codebase directly from the
site.  This has to use sudo on the backend to run the update, and this is accomplished through a bash script that has
privileges via sudoers.

## Slickgrid

Most of the pages that display tabular data use a modified [Slickgrid](https://github.com/mleibman/SlickGrid) to display
the data.  Slickgrid is a Javascript Grid, similar to DataTables.  It's strength comes from a view I built that allows
for backend pagination and caching.

Using an ajax call, I pull down the first 500 records and cache them.  I also calculate the total number of records (for
instance, there are about 90,000 links).  Using this data, I can display the first page of data (25 records) and the user
can browse page to page up to the first 500.  Once the user requests record #501, an additional ajax call is submitted to
download and cache records 501-1000.  If a user jumps to the last page, an ajax call is made to cache the last 500 records.

This innovative approach allows the grid to easily handle millions of records with almost no lag.  Additionally, using the
caching mechanism reduces the need to make ajax calls on every page request.