## Project requirements 

### Database structure

#### Models: 

**1. User** 

Holds information about the user. 3 main user groups: 
- Admin
- Company 
- Individual

Columns:
```
- uuid (uuid)
- first_name (string)
- last_name (string)
- email (string)
- group (integer)
- password (hash)
- phone (string)
- company (string - nullable)
- country_id (integer)
- preferred_language (string - default to “en”)
- privacy (bool) - default to false
- timestamps (default laravel timestamps)
- email_verified_at (default laravel timestamp)
```

Notes: 

- `ulid` - will use this as a primary key. Package info [here](https://github.com/robinvdvleuten/php-ulid).
- `country_id` - related to countries table (add foreign key constraint)
- `preferred_language` - will be used to determine preferred language of the user. For now we will default this to **_en_**
- `privacy` - determines if user data will be shown on the post details

**2. Post**

This will represent a post that user can create. Each post will have a corresponding user & category. 

Columns:
```
- id
- user_id (string)
- category_id (int)
- type_id (int)
- timestamps + soft deletes (default laravel columns)
- title (string)
- description (text)
- country_id (integer)
- city (string)
- address (string)
- zip_code (string)
- latitude (float/double)
- longitude (float/double)
- active (bool) - default to true
- status (int)
- price (double/float)
- price_negotiable (bool - default false)
- attributes (json) 
- available_from (date)  - nullable
- available_until (date) - nullable 
- last_renewed_on (timestamp) - nullable
```

Notes: 
- `user_id` - related to User model - add foreign key constraint
- `category_id` - related to Category model - add foreign key constraint
- `country_id` - related to countries table (add foreign key constraint)
- `type_id` - related to PostType model (add foreign key constraint)
- `city` - will be generated automatically base on google geoLoc API
- `address` - will be generated automatically base on google geoLoc API
- `zip_code` - will be generated automatically base on google geoLoc API
- `latitude` - will be generated automatically base on google geoLoc API
- `longitude` - will be generated automatically base on google geoLoc API
- `attributes` - list of attributes that will be added from PostAttributes list
- `active` - used to determine if post will be visible on FE or not
- `status` - determines the status of the property - sold, rented..
- `price_negotiable` - used to determine if price will be negotiable, so we can show additional content on the post details page
- `last_renewed_on` - date when the post was last manually renewed. Determines the expiry date of the post

Note 2:
- Country will be selected from dropdown. All other fields will be selected from "location" input

**3. Countries** 

Holds list of all countries available countries and currencies in ISO3166 format. Possibly use [this](https://github.com/umpirsky/country-list) to seed the database.

Columns
```
- name (string)
- code (string)
- currency_code (string)
```

**4. Categories**

List of categories. In the future, category might have a parent (multi level categories)

Columns:
```
- name (string)
- parent_category_id (integer)
```
Notes:
- `parent_category_id` - used to determine if category has a parent. Related to the record in the same table

**5. PostImage**

This holds all the post images. One post can have one featured image and multiple additional images

Columns:
```
- post_id (integer)
- image (string)
- featured (boolean) - default to false
```

Notes: 
- `post_id` - Related to Post model. Add foreign key constraint
- `image` - path of the image. This will come from DigitalOcean S3 storage
- `featured` - used to determine which image is the featured one

**6. PostAttachment**

This holds all the attachments of a post. One post can have multiple attachments with different types.

Columns
```
- post_id (int)
- type (string)
- path (string)
```

Notes
- `post_id` - Related to Post model. Add foreign key constraint
- `path` - path of the attachment. This will come from DigitalOcean S3 storage

**7. PostType**

Type of the post. It can be a sell or rent.

Columns:
```
- post_id (int)
- type (int)
```

Notes:
- `post_id` - Related to Post model. Add foreign key constraint

**8. PostAttributes**

List of available properties/attributes for a post (property size, land size...). Each property can have a different unit and type. This will be used on posts form, where user will be able to select this attributes and add a desired value to them

Columns
```
- name (string)
- unit (string)
- mandatory (bool) - default false
- type (string)
- possible_values (json) - nullable
```

Notes: 
- `mandatory` - will be used for form validation. If a field is mandatory, user won't be able to submit a form withouth that attribute
- `possible_values` - predefined values for an attribute

