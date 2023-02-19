# Database

Based on https://www.doctrine-project.org/projects/doctrine-dbal/en/current/index.html

```yaml
extract:
  pull:
    type: database
    uri: pdo-sqlite://user:password@host:1234/../demo/database_in.sqlite
  read:
    format: database
    options:
      # select: ['value']
      from: key_values
      where: 'key <> :forbidden_key AND value <> :forbidden_value'
      parameters:
        forbidden_key: 'foo'
        forbidden_value: 'value'

transform:
  type: expressive
  mapping:
    out.value: in.key
    out.key: in.value

load:
  write:
    format: database
    options:
      into: key_values
  push:
    type: database
    uri: pdo-sqlite://user:password@host:1234/../demo/database_out.sqlite
```
