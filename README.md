# No code self-runnable micro ETL

**THIS IS A PROOF OF CONCEPT AND WORK IN PROGRESS**

[ETL: Extract, Transform, Load](https://en.wikipedia.org/wiki/Extract,_transform,_load)

This App is a self running App that will
- **Extract** data from a given source
- **Transform** it as you need
- **Load** the result to a given destination

It's meant to be used as a stand-alone App which is triggered and run by a CI/CD.

You should find your way in without the need to code anything (for most basic use cases).  
Still it can be extended for specific source, destination, format or workflow (advanced).

It comes with all the needed documentation and examples for the ETL part, 
and even specific documentation for major code hosting services.

**IMPORTANT**

It's not adapted for big volume or intense App,
if you trigger the ETL more than twice a day you probably need something more powerful.  
*Depending on your usage, this may even go against some providers terms of service.*

## Basic Example

In this basic example:
 - We are getting a CSV file from the local repository
 - We transform the data a bit
 - We send back the transformed data into an API as JSON

```yaml
extract:
  pull:
    type: file
    uri: ./demo/data_in.csv
  read:
    format: csv
    options:
      trim: true

transform:
  type: expressive
  mapping:
    out.name: in.Name
    out.sex: in.Sex
    out.age_in_sec: 'in.Age * 365 * 24 * 60 * 60'

load:
  write:
    format: json
  push:
    type: http
    uri: https://example.org/api/customer
    options:
      headers:
        'Authorization': 'Basic 9e222b3b7647c7'
```

## Configuration

On the ETL part, everything is configured into one single file that describe each steps: `config.yaml`.  
But for the sake of simplicity, the documentation has been split into multiple sections.

- [HTTP and API](documentation/http.md)
- [Database](documentation/database.md)
- [File (local and distant)](documentation/file.md)
- [Templates (Twig)](documentation/twig.md)

## Triggering runs

The following documentation is provider specific and partially out of the scope of this project.

- [GitLab](documentation/trigger_gitlab.md)
- [GitHub](documentation/trigger_github.md)

## Handling secrets

Before diving into handling secrets, you probably can start by running this project on a private repository.

The following documentation is provider specific and partially out of the scope of this project.

- [GitLab](documentation/secret_gitlab.md)
- [GitHub](documentation/secret_github.md)

## Commit back to the repository

The following documentation is provider specific and partially out of the scope of this project.

- [GitLab](documentation/commit_back_gitlab.md)
- [GitHub](documentation/commit_back_github.md)

## [Technical documentation](app/README.md)

...


## Licence

MIT

## Attributions

`data_in.csv` comes from: https://people.sc.fsu.edu/~jburkardt/data/csv/csv.html
