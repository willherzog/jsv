# JSV
JavaScript Value filter: Output ECMAScript format of input value.
## Usage
```
{# templates/example.html.twig #}

<script>
	const scriptVariable = {{ twig_variable|jsv }};
</script>