# Janus Henderson WordPress Skills Assessment

## Custom Plugin Development Task

In this task you will ingest content from the New York Times' "Top Stories" API into WordPress. Below is a simple mockup of how this task would be detailed in a Jira Story at Janus Henderson. Before you dive into the story, here are a few development requirements.

### Instructions
- Fork this repo and clone it locally.
- Build/develop the plugin according to the requirements listed below.
- Add the plugin to a vanilla install of running WordPress so you can demo your code during future discussions.
- Make a pull request to this repo with your completed code prior to the next discussion.

### Restrictions
- Do not create a plugin from scratch. Please use the plugin found in `wp-content/plugins/jh-nyt-top-stories`. This plugin uses the [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate), an Object-Oriented boilerplate used for plugin development at Janus Henderson.

- All development should be done in the `jh-nyt-top-stories` plugin. Do not create other plugins, files, or edit any theme files.
---

### Jira Story Description

As a user, I want to have the New York Times' "Top Stories" imported into WordPress on an hourly basis, so they can be used throughout the site.

### Acceptance Criteria / Requirements

- Create a new custom post type called "NYT Top Stories". This CPT should be public, have both categories and tags, but not be searchable.
- Data should be sourced from `https://api.nytimes.com/svc/topstories/v2/home.json?api-key=[KEY_GOES_HERE]`. Each NYT story in the `results` section of the response should be imported into WP using the newly created CPT.

  - **NOTE: You can sign up for your own free key at [developer.nytimes.com](https://developer.nytimes.com/)**


- The data from the API response should be mapped in WP as follows.

  - title --> Post Title
  - abstract --> Post Excerpt
  - published_date --> Post Date
  - url --> A post meta field called 'URL'
  - byline --> A post meta field called 'byline'
  - section --> Categories
  - des_facet --> Tags


- The import should run on an hourly basis using WP Cron


- NYT Stories should not be duplicated if they already exist WP. There is no need to update stories if they already exist in WP.


- Create a short code that lists the 5 newest stories

  - The stories should be displayed in an unordered list
  - The list should be ordered from newest to oldest
  - Each item in the list should include a title that links to the story with the
    byline underneath the title (the byline does not link to anything).

### Bonus Points ###

The below tasks are not required for this skill assessment, but they are worth a few bonus points :)

- Create a WP CLI command that can be run to trigger the import at any time.
- Create an admin page where a user can click a button to trigger an import. 
