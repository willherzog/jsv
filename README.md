# JSV
JavaScript Value filter for the Twig templating engine: Output the ECMAScript format of the PHP input value.
## Usage
```
{# templates/example.html.twig #}

<script>
	const scriptVariable = {{ twig_variable|jsv }};
</script>