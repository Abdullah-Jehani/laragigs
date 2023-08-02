<!-- wrapper => this component function is only to wrap the card content -->
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}} >
    <!-- so we can pass any content we need -->
    {{$slot}}
</div>