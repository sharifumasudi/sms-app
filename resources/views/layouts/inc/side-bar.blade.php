<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-list-2"></i><span class="nav-text">{{ __('SMS') }}</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('sms.category.index') }}">{{ __('Categories') }}</a></li>
                    <li><a href="{{ route('sms.receiver.index') }}">{{ __('Receivers') }}</a></li>
                    <li><a href="{{ route('sent.sms') }}">{{ __('Sent') }}</a></li>
                    <li><a href="{{ route('sms.new.sms') }}">{{ __('Publish') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
