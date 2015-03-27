FIXTURES
========

For the project we are using **DoctrineFixturesBundle** which provide us an easy way to use fixtures in a project.
But for a more easy implementation of our fixtures we are using **KhepinYamlFixturesBundle**. With it we can write our fixtures in yaml.
For now, they are located in 
> src/Festitime/DatabaseBundle/Ressources/fixtures/

Basic Rules
-----------

1. Create one file per document
2. Each fixture file must respect the following pattern :

    {**DocumentName**}.fixtures.yml

3. Fixtures files must use the following header :

```yaml
    # You must change DocumentName by the actual document name
    model: Festitime\DatabaseBundle\Document\DocumentName
    save_in_reverse: false
    persistence: mongodb
    # Here start the fixtures data
    fixtures:
        # Each element here is a fixture (don't hesitate to give a more understandable name)
        fixture1:
            # Each element here is a field of the target document
            field1: data field 1
            # For collection element you have to respect the following syntax
            field2:
                - data1
                - data2
        fixture2: ~
```

Full Documentation
------------------

[See the full documentation](https://github.com/khepin/KhepinYamlFixturesBundle)
