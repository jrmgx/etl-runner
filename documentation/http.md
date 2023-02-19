# HTTP

```yaml
extract:
  pull:
    type: http
    uri: http://0.0.0.0:1234/demo/index.php?route=get
    options:
      method: GET
  read:
    format: json
    options:
      associative: true

transform:
  type: expressive
  mapping:
    out.value: 'in.index ** in.index'
    out.key: in.data

load:
  write:
    format: json
  push:
    type: http
    uri: http://0.0.0.0:1234/demo/index.php?route=post
    options:
      method: POST
```
