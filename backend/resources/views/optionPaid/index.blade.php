<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div id="search-container" class="flex justify-end pr-5 mb-4">
        <div class="relative pr-4 lg:mx-0">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
              <path
                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </span>
          <input id="searchInput" class="form-input w-full md:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
            type="text" placeholder="Search Option paid..." onkeyup="searchUsers(this.value)">
        </div>
        @can('OptionPaid create')
      <a href="{{ route('admin.optionPaid.create') }}"
        class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">New
        Option Paid</a>
    @endcan
      </div>
      <div class="bg-white shadow-md rounded my-6">
        <table id="category" class="min-w-full bg-white border border-gray-300">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b">Id</th>
              <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b">Option Paid</th>
              <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b text-right">Amount</th>
              <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b text-right">Action</th>
            </tr>
          </thead>
          <tbody>
            @can('OptionPaid access')
        @foreach ($optionPaids as $optionPaid)
      <tr class="hover:bg-gray-50">
        <td class="py-4 px-6 border-b">{{ $loop->index + 1 }}</td>
        <td class="py-4 px-6 border-b" id="optionPaid">{{ $optionPaid->option_paid }}</td>
        <td class="py-4 px-6 border-b text-right">{{ $optionPaid->amount }} $</td>
        <td class="py-4 px-6 border-b text-right">
        @can('OptionPaid edit')
      <a href="{{route('admin.optionPaid.edit', $optionPaid->id)}}"
      class="px-4 py-2 font-medium text-white bg-green-700 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Edit</a>
    @endcan
        @can('OptionPaid delete')
      <form action="{{ route('admin.optionPaid.destroy', $optionPaid->id) }}" method="POST" class="inline">
      @csrf
      @method('delete')
      <button onclick="confirmDelete(this)"
      class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out">Delete</button>
      </form>
    @endcan
        </td>
      </tr>
    @endforeach
      @endcan
          </tbody>
        </table>
        @can('category access')
      <div class="text-right p-4">
        {{ $optionPaids->links() }}
      </div>
    @endcan
      </div>
    </div>
  </main>
</x-app-layout>

<script>
function confirmDelete(button) {
      if (confirm("Are you sure you want to delete this item?")) {
        button.closest('form').submit();
      }
    }


    function searchUsers(searchTerm) {
    let trs = document.querySelectorAll('tbody tr');
    searchTerm = searchTerm.toLowerCase();
    let foundItem = false;

    trs.forEach(tr => {
        let optionPaid = tr.querySelector('#optionPaid').textContent.toLowerCase();
        if (optionPaid.includes(searchTerm)) {
            tr.style.display = '';
            foundItem = true;
        } else {
            tr.style.display = 'none';
        }
    });

  }  

</script>