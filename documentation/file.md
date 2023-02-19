# File

```yaml
extract:
# For now, we don't have short version of those
#    pull: /data_in.csv
    pull:
        # type: https | ftp | git | file
        type: file
        # uri: https://example.com/file.xml
        uri: ./data_in.csv
        options:
            http_option_x: value
            http_option_y: value
#    read: csv | xml | json
    read:
        format: csv
        options:
            separator: ","
            enclosure: '"'
            trim: true
            header: true

# This can be left empty, even removed: it means "identity"
transform:
#    type: simple
#    mapping:
#        out.name: in.Name
#        out.sex: in.Sex
#        out.years_count: in.Age
#        out.height: "in.Height (in)"
    type: expressive
    mapping:
        out.name: in.Name
        out.sex: in.Sex
        out.years_count: 'in.Age * 100'
        # out.height: 'in.Height (in)'

load:
#    write: csv | xml | json
    write:
        #format: csv | xml | json
        format: json

    #    push: /data_out.xml
    push:
        # type: https | git | ...
        type: file
        uri: ./data_out.json
#        uri: gitlab.com/my-project
        options:
            username: git
            password: xxx

```
