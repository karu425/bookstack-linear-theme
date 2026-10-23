@inject('headContent', 'BookStack\Theming\CustomHtmlHeadContentProvider')

@if(!request()->routeIs('settings.category'))
<!-- Start: custom user content -->
{!! $headContent->forWeb() !!}
<!-- End: custom user content -->
@include('layouts.parts.linear-styles')
@include('layouts.parts.linear-interface')
@endif
