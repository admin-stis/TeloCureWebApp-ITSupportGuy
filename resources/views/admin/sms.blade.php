@extends('admin.layout')

@section('content')
  @php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp 


<form>
  <div class="card" style="padding: 10px">
    <div class="form-group">
    <label for="comment">Send SMS to Doctor :</label>
      <textarea class="form-control " rows="5" id="comment" name="text"></textarea>
  </div>

@if($editPermission)
  <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Send SMS DOCTOR</button>
    </div>
@endif 

  </div>
</form>
<form>
  <div class="card" style="padding: 10px">
    <div class="form-group">
    <label for="comment">Send SMS to Patient :</label>
      <textarea class="form-control " rows="5" id="comment" name="text"></textarea>
  </div>
@if($editPermission)
  <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Send SMS PATIENT</button>
    </div>
@endif 
  </div>
</form>


@endsection
