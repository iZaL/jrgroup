@if(App::getLocale() == 'en')
    <div class="hidden-xs localeCode pull-right">
        {{link_to_route('language.select', 'العربية', array('ar'))}} <i class="fa fa-globe"></i>
    </div>
@else
    <div class="hidden-xs localeCode pull-left">
        {{link_to_route('language.select', 'English', array('en'))}}  <i class="fa fa-globe"></i>
    </div>
@endif