<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>{{ $pageTitle }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
  background:#eef1f4;
  font-family:Tahoma, Arial, sans-serif;
  direction:rtl;
  font-size:14px;
}
.entry-box{
  background:#fff;
  border:1px solid #cfd6dd;
  box-shadow:0 2px 6px rgba(0,0,0,.06);
}
.entry-header{
  background:#e6edf5;
  border-bottom:1px solid #cfd6dd;
  padding:8px 12px;
  font-weight:bold;
  color:#1f3b5c;
}
.form-control, .form-select{
  height:30px;
  font-size:13px;
}
.table-entry th{
  background:#f2f5f8;
  font-size:13px;
}
.table-entry td{
  padding:4px;
  vertical-align:middle;
}
.action-bar{
  background:#f2f5f8;
  border-top:1px solid #cfd6dd;
  padding:6px;
}
</style>
</head>

<body>

<div class="container-fluid p-3">

{{-- 🔹 الفورم مربوط بالـ Route الصحيح --}}
<form method="POST" action="{{ route('operations.store', $type) }}">
@csrf

<div class="entry-box">

<div class="entry-header">
  {{ $pageTitle }}
</div>

{{-- ================= Header Data ================= --}}
<div class="p-3">
  <div class="row g-2">

    {{-- رقم العملية (AUTO) --}}
    <div class="col-md-3">
      <label class="form-label">رقم العملية</label>
      <input class="form-control" value="AUTO" readonly>
      {{-- الرقم الحقيقي يُنشأ في الباك --}}
      <input type="hidden" name="number" value="{{ uniqid() }}">
    </div>

    {{-- التاريخ --}}
    <div class="col-md-3">
      <label class="form-label">التاريخ</label>
      <input type="date"
             name="date"
             class="form-control"
             required>
    </div>

    {{-- المورد / العميل --}}
    <div class="col-md-3">
      <label class="form-label">{{ $partnerLabel }}</label>
      <select name="partner_id"
              class="form-select form-select-sm"
              required>
        <option value="">---</option>
        {{-- @foreach($partners as $partner) --}}
        {{-- <option value="{{ $partner->id }}">{{ $partner->name }}</option> --}}
        {{-- @endforeach --}}
      </select>
    </div>

    {{-- المخزن --}}
    <div class="col-md-3">
      <label class="form-label">المخزن</label>
      <select name="warehouse_id"
              class="form-select form-select-sm"
              required>
        {{-- @foreach($warehouses as $warehouse) --}}
        {{-- <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option> --}}
        {{-- @endforeach --}}
        <option value="1">المخزن الرئيسي</option>
      </select>
    </div>

  </div>
</div>

{{-- ================= Items Table ================= --}}
<div class="px-3 pb-3">
<table class="table table-bordered table-entry text-center mb-0">
<thead>
<tr>
  <th>#</th>
  <th>🔍</th>
  <th>الصنف</th>
  <th>الباركود</th>
  <th>الفئة</th>
  <th>الوحدة</th>

  {{-- انتهاء الصلاحية يظهر فقط في التوريد --}}
  @if($type === 'in')
    <th>انتهاء</th>
  @endif

  <th>الكمية</th>
  <th>+</th>
  <th>×</th>
</tr>
</thead>

<tbody id="items-table">
<tr>
  <td class="row-index">1</td>

  {{-- زر البحث --}}
  <td>
    <button type="button"
            class="btn btn-sm btn-light open-item-modal"
            data-bs-toggle="modal"
            data-bs-target="#itemSearchModal">🔍</button>
  </td>

  {{-- الصنف --}}
  <td>
    <input type="text"
           class="form-control form-control-sm item-name"
           readonly>
    <input type="hidden"
           class="item-id"
           name="items[0][item_id]"
           required>
  </td>

  <td>
    <input type="text"
           class="form-control form-control-sm barcode"
           readonly>
  </td>

  <td>
    <input type="text"
           class="form-control form-control-sm category"
           readonly>
  </td>

  <td>
    <input type="text"
           class="form-control form-control-sm unit"
           readonly>
  </td>

  {{-- تاريخ الانتهاء --}}
  @if($type === 'in')
  <td>
    <input type="date"
           class="form-control form-control-sm"
           name="items[0][expiry_date]"
           required>
  </td>
  @endif

  {{-- الكمية --}}
  <td>
    <input type="number"
           class="form-control form-control-sm quantity"
           name="items[0][quantity]"
           min="1"
           required>
  </td>

  <td>
    <button type="button"
            class="btn btn-sm btn-light add-row">➕</button>
  </td>
  <td>
    <button type="button"
            class="btn btn-sm btn-light text-danger delete-row">✖</button>
  </td>
</tr>
</tbody>
</table>
</div>

{{-- ================= Actions ================= --}}
<div class="action-bar">
  <button type="submit" class="btn btn-sm btn-primary">
    حفظ العملية
  </button>
</div>

</div>
</form>
</div>

{{-- ================= Modal البحث (كما هو – Placeholder) ================= --}}
<div class="modal fade" id="itemSearchModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">بحث عن صنف</h5>
  <button class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <input class="form-control mb-3" placeholder="بحث بالاسم أو الباركود">
  <p class="text-muted text-center">سيتم ربط البحث بالقاعدة لاحقًا</p>
</div>
</div>
</div>
</div>

{{-- ================= JS ================= --}}
<script>
let activeRow = null;

document.addEventListener('click', e => {

  if(e.target.closest('.open-item-modal')){
    activeRow = e.target.closest('tr');
  }

  if(e.target.closest('.add-row')){
    const row = e.target.closest('tr');

    if(row.querySelector('.item-id').value==='' ||
       row.querySelector('.quantity').value===''){
      alert('اختر الصنف وأدخل الكمية أولاً');
      return;
    }

    const newRow = row.cloneNode(true);
    newRow.querySelectorAll('input').forEach(i=>i.value='');
    document.getElementById('items-table')
      .insertBefore(newRow,row.nextSibling);
    reindex();
  }

  if(e.target.closest('.delete-row')){
    const rows = document.querySelectorAll('#items-table tr');
    if(rows.length===1){
      alert('لا يمكن حذف آخر صف');
      return;
    }
    e.target.closest('tr').remove();
    reindex();
  }
});

function reindex(){
  document.querySelectorAll('#items-table tr').forEach((r,i)=>{
    r.querySelector('.row-index').innerText=i+1;
    r.querySelectorAll('input').forEach(el=>{
      if(el.name){
        el.name = el.name.replace(/items\[\d+\]/,'items['+i+']');
      }
    });
  });
}
</script>

</body>
</html>
