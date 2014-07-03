@if(App::getLocale() == 'en')
    <div class="hidden-xs localeCode pull-right">
@else
    <div class="hidden-xs localeCode pull-left">
@endif
    @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
    <?php $localeCode = 'ar' ;?>
    <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
        العربية <i class="glyphicon  glyphicon-globe"></i>
    </a>
    @else
    <?php $localeCode = 'en' ;?>
    <a  rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
        En <i class="glyphicon  glyphicon-globe"></i>
    </a>
    @endif
</div>
@if(App::getLocale() == 'en')
    <div class="visible-xs localeCode pull-right">
@else
    <div class="visible-xs localeCode pull-left">
@endif
    @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
    <?php $localeCode = 'ar' ;?>
    <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
        العربية <i class="glyphicon  glyphicon-globe"></i>
    </a>
    @else
    <?php $localeCode = 'en' ;?>
    <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
        En <i class="glyphicon  glyphicon-globe"></i>
    </a>
    @endif
</div>