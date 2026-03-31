            <div class="col-md-3">
                <div class="d-flex flex-column nav-sidebar" style="gap: 25px;">
                    <a href="{{ route('user.dashboard') }}" class="text-dark" style="font-weight: 600; font-size: 15px; letter-spacing: 1px;">DASHBOARD</a>
                    <a href="{{ route('user.profile') }}" class="text-dark" style="font-weight: 600; font-size: 15px; letter-spacing: 1px;">PROFILE EDIT</a>
                    
                    <details>
                        <summary class="text-dark" style="font-weight: 600; font-size: 15px; letter-spacing: 1px; cursor: pointer; outline: none;">
                            BILLING 
                        </summary>
                        <div class="d-flex flex-column mt-3" style="gap: 15px; padding-left: 15px;">
                            <a href="{{ route('billing-address.create') }}" class="text-dark" style="font-weight: 600; font-size: 14px; letter-spacing: 1px;">BILLING ADDRESS</a>
                            <a href="{{ route('payment.history') }}" class="text-dark" style="font-weight: 600; font-size: 14px; letter-spacing: 1px;">PAYMENT HISTORY</a>
                        </div>
                    </details>

                    <a href="{{ route('content-rating-form') }}" class="text-dark" style="font-weight: 600; font-size: 15px; letter-spacing: 1px;">CONTENT RATING</a>
                    
                    <a href="{{ route('password.change.form') }}" class="text-dark" style="font-weight: 600; font-size: 15px; letter-spacing: 1px;">PASSWORD CHANGE</a>

                    
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="text-dark mt-4" style="font-weight: 600; font-size: 15px; letter-spacing: 1px;">
                       <i class="ti-control-play" style="font-size:12px; margin-right:5px;"></i> LOGOUT
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>