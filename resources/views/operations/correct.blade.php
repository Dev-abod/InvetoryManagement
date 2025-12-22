<form method="POST" action="{{ route('operations.correct', $operation->id) }}">
@csrf

<h4 class="mb-3">
  Correct Operation #{{ $operation->number }}
</h4>

<table class="table table-bordered text-center">
  <thead>
    <tr>
      <th>Item</th>
      <th>Old Qty</th>
      <th>New Qty</th>
    </tr>
  </thead>
  <tbody>
  @foreach($operation->details as $detail)
    <tr>
      <td>{{ $detail->item->name }}</td>
      <td>{{ $detail->quantity }}</td>
      <td>
        <input type="number"
               name="items[{{ $detail->item_id }}]"
               value="{{ $detail->quantity }}"
               min="0"
               class="form-control"
               required>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="mt-3 d-flex gap-2">
  <button type="submit" class="btn btn-warning">
    Apply Correction
  </button>

  <button type="button"
          onclick="window.history.back()"
          class="btn btn-secondary">
    Cancel
  </button>
</div>
</form>
