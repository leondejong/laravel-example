<tr>
    <td>
        <a href="{{ route('collection.show', ['collection' => $entry]) }}">
            {{ $entry->name }}
        </a>
    </td>
    <td>
        {{ $entry->user ? $entry->user->name : __('collection.none') }}
    </td>
    <td>
        {{ $entry->description ? $entry->description : __('collection.none') }}
    </td>
    <td>
        <button type="button" class="btn btn-danger float-right m-1"
            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $entry->id }}').submit();">
            @lang('collection.delete')
        </button>
        <a role="button" class="btn btn-primary float-right m-1 d-inline-block"
            href="{{ route('collection.edit', ['collection' => $entry]) }}">
            @lang('collection.update')
        </a>
        <form id="delete-form-{{ $entry->id }}" method="post"
            action="{{ route('collection.destroy', ['collection' => $entry]) }}" style="display: none;">
            @csrf @method('delete')
        </form>
    </td>
</tr>