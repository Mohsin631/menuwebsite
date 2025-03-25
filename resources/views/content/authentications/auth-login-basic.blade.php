@extends('layouts/blankLayout')

@section('title', 'تسجيل الدخول - الصفحات')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- تسجيل -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- الشعار -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
            </a>
          </div>
          <!-- /الشعار -->
          <h4 class="mb-1">مرحبًا! 👋</h4>
          <p class="mb-6">يرجى تسجيل الدخول إلى حسابك</p>

          <form id="formAuthentication" class="mb-6" action="{{url('/')}}" method="GET">
            <div class="mb-6">
              <label for="email" class="form-label">البريد الإلكتروني أو اسم المستخدم</label>
              <input type="text" class="form-control" id="email" name="email-username" placeholder="أدخل بريدك الإلكتروني أو اسم المستخدم" autofocus>
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">كلمة المرور</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <div class="mb-8">
              <div class="d-flex justify-content-between mt-8">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    تذكرني
                  </label>
                </div>
                <a href="{{url('auth/forgot-password-basic')}}">
                  <span>هل نسيت كلمة المرور؟</span>
                </a>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /تسجيل -->
  </div>
</div>
@endsection
