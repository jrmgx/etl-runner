# No code self-runnable micro ETL

**THIS IS A PROOF OF CONCEPT AND WORK IN PROGRESS**

This App is a self running App that will
- **Extract** data from a given source
- **Transform** it as you need
- **Load** the result to a given destination

It's meant to be used as a stand-alone App which is triggered and run by a CI/CD.  

It comes with documentation and examples for both GitLab and GitHub.  
You should find your way in without the need to code anything (for most basic use cases).   
Still it can be extended for specific source, destination, format or workflow.

*Note: this is a proof of concept and may goes against GitLab and GitHub term of service.*

It's not adapted for big volume or intense App, 
if you trigger the ETL more than twice a day you probably need something more powerful.

# Licence

MIT

# Attributions

`data_in.csv` comes from: https://people.sc.fsu.edu/~jburkardt/data/csv/csv.html

# External documentation

- https://docs.gitlab.com/ee/ci/pipelines/schedules.html
- https://gitlab.com/jrmgx/etl/-/pipeline_schedules/new
