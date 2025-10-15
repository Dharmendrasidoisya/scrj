@php
    Theme::layout('full-width');
@endphp
<section class="pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="profile-sidebar crop-avatar">
                                    <form id="avatar-upload-form" enctype="multipart/form-data" action="javascript:void(0)" onsubmit="return false">
                                        <div class="avatar-upload-container">
                                            <div class="form-group mb-0">
                                                <div id="account-avatar">
                                                    <div class="profile-image">
                                                        <div class="avatar-view mt-card-avatar">
                                                            <img class="br2 align-middle" src="{{ auth('customer')->user()->avatar_url }}" alt="{{ auth('customer')->user()->name }}">
                                                            <div class="mt-overlay br2">
                                                                <span><i class="fa fa-edit"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="print-msg" class="text-danger hidden"></div>
                                        </div>
                                    </form>
                                    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="avatar-form" method="post" action="{{ route('customer.avatar') }}" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="avatar-modal-label"><i class="til_img"></i><strong>{{ __('Profile Image') }}</strong></h4>
                                                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="avatar-body">
                                                            <!-- Upload image and data -->
                                                            <div class="avatar-upload">
                                                                <input class="avatar-src" name="avatar_src" type="hidden">
                                                                <input class="avatar-data" name="avatar_data" type="hidden">
                                                                {!! csrf_field() !!}
                                                                <label class="form-label" for="avatarInput">{{ __('New image') }}</label>
                                                                <input class="avatar-input avatar-input bg-transparent ms-0" id="avatarInput" name="avatar_file" type="file">
                                                            </div>

                                                            <div class="loading" tabindex="-1" role="img" aria-label="{{ __('Loading') }}"></div>

                                                            <!-- Crop and preview -->
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="avatar-wrapper"></div>
                                                                    <div class="error-message text-danger" style="display: none"></div>
                                                                </div>
                                                                <div class="col-md-3 avatar-preview-wrapper">
                                                                    <div class="avatar-preview preview-lg"></div>
                                                                    <div class="avatar-preview preview-md"></div>
                                                                    <div class="avatar-preview preview-sm"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-small btn-secondary" type="button" data-dismiss="modal">{{ __('Close') }}</button>
                                                        <button class="btn btn-small btn-primary avatar-save" type="submit">{{ __('Save') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="profile-usertitle-name pt-2">
                                    <strong>{{ auth('customer')->user()->name }}</strong>
                                    <p><small>{{ auth('customer')->user()->email }}</small></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="dashboard-menu">
                            <ul class="nav flex-column">
                                @foreach (DashboardMenu::getAll('customer') as $item)
                                    @continue(! $item['name'])

                                    <li class="nav-item">
                                        <a
                                            @class(['nav-link', 'active' => $item['active']])
                                            href="{{ $item['url'] }}"
                                        >
                                            <x-core::icon :name="$item['icon']" />

                                            {{ $item['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content dashboard-content">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
