
<h1>Categories</h1>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

<a class="create-button" href="{{ route('categories.create') }}" type='button'>Create category</a>

<table>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Action</th>

    </tr>
    @foreach ($items as $category)
    <tr>
      <td>
        <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}
        </a>
      </td>
      <td>{{ $category->description }}</td>
      <td>
        <a href="{{ route('categories.edit', $category->id) }}">
          Edit
        </a>
      </td>

    </tr>
    @endforeach
  </table>

  <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .create-button {
      display: inline-block;
      padding: 6px 12px;
      background: rgb(36, 108, 237);
      border-radius: 4px;
      color: white;
      border: none;
      cursor: pointer;
      margin: 10px 0;
      text-decoration: none;
    }

    .create-button:hover {
      opacity: 0.7;
    }
</style>
