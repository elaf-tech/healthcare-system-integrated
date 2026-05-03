@extends('User.master')
<base href="/public">
@section('content')

<div class="hospital-form-container new-style" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="form-header text-center mb-4">
          <h1 class="display-5 gradient-text">{{__('web.addHos')}}</h1>
          <p class="lead text-muted">{{__('web.addHosdes')}}</p>
        </div>
        <div class="hospital-form-card shadow-lg">
          <form action="{{ route('hospitals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- القسم الأول: المعلومات الأساسية -->
            <div class="form-section active">
              <div class="section-header">
                <i class="fas fa-hospital icon-circle"></i>
                <h3>{{__('web.basicInfo')}}</h3>
              </div>
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" required placeholder=" ">
                    <label>{{__('web.HosName')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="license_number" class="form-control" required placeholder=" ">
                    <label>{{__('web.LicNum')}}</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea name="address" class="form-control" style="height: 100px" required placeholder=" "></textarea>
                    <label>{{__('web.Add')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="hospital_phone" class="form-control" required placeholder=" ">
                    <label>{{__('web.HosPhone')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{__('web.LicDoc')}}</label>
                  <div class="file-upload-wrapper">
                    <input type="file" name="license_document" class="file-upload" accept="image/*">
                    <div class="file-upload-preview rounded shadow-sm"></div>
                  </div>
                </div>
              </div>
              <div class="form-navigation mt-4">
                {{-- <button type="button" class="btn btn-gradient btn-next">
                  {{__('web.Nex')}} <i class="fas fa-arrow-left"></i>
                </button> --}}
              </div>
            </div>

            <!-- القسم الثاني: معلومات المالك -->
            <div class="form-section">
              <div class="section-header">
                <i class="fas fa-user-tie icon-circle"></i>
                <h3>{{__('web.OwnerInfo')}}</h3>
              </div>
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="owner_name" class="form-control" required placeholder=" ">
                    <label>{{__('web.OwnerName')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="owner_phone" class="form-control" required placeholder=" ">
                    <label>{{__('web.OwnerPhon')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="date" name="license_date" class="form-control" required placeholder=" ">
                    <label>{{__('web.LiceDate')}}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{__("web.HosImage")}}</label>
                  <div class="file-upload-wrapper">
                    <input type="file" name="image" class="file-upload" accept="image/*">
                    <div class="file-upload-preview rounded shadow-sm"></div>
                  </div>
                </div>
              </div>
              <div class="form-navigation mt-4 d-flex justify-content-between">
                {{-- <button type="button" class="btn btn-light btn-prev">
                  <i class="fas fa-arrow-right"></i> {{__('web.Prev')}}
                </button> --}}
                <button type="submit" class="btn btn-gradient">
                    {{__('web.Save')}} <i class="fas fa-check-circle"></i>
                  </button>

                  <a href="{{route('hospitals.index')}}" class="btn btn-secondary">
                    {{__('web.Cancel')}} <i class="fas fa-check-circle"></i>
                  </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* خطوط وألوان حديثة */
.gradient-text {
  background: linear-gradient(90deg, #00b09b, #96c93d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hospital-form-container.new-style {
  background: #f9fafb;
  min-height: 100vh;
}

.hospital-form-card {
  background: white;
  border-radius: 20px;
  padding: 30px;
}

.section-header {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 25px;
}

.icon-circle {
  background: linear-gradient(135deg, #00b09b, #96c93d);
  color: white;
  width: 45px;
  height: 45px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}

/* أزرار جذابة */
.btn-gradient {
  background: linear-gradient(135deg, #00b09b, #96c93d);
  color: white;
  border: none;
  padding: 10px 25px;
  border-radius: 30px;
  transition: transform 0.2s;
}

.btn-gradient:hover {
  transform: translateY(-2px);
}

.file-upload-wrapper {
  border: 2px dashed #cbd5e1;
  border-radius: 12px;
  padding: 10px;
  text-align: center;
  cursor: pointer;
}

.file-upload-preview img {
  max-width: 100px;
  max-height: 100px;
  margin-top: 10px;
  border-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sections = document.querySelectorAll('.form-section');
  let current = 0;
  document.querySelector('.btn-next').addEventListener('click', () => {
    sections[current].classList.remove('active');
    current++; sections[current].classList.add('active');
  });
  document.querySelector('.btn-prev').addEventListener('click', () => {
    sections[current].classList.remove('active');
    current--; sections[current].classList.add('active');
  });

  // معاينة الصور
  document.querySelectorAll('.file-upload').forEach(input => {
    const preview = input.nextElementSibling;
    input.addEventListener('change', e => {
      if (e.target.files.length) {
        const reader = new FileReader();
        reader.onload = e => {
          preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  });
});
</script>
@endsection
