<nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		@if ($paginator->onFirstPage())
		<li class="page-item disabled">
			<a href="" class="disabled page-link">
				
				<span aria-hidden="true">«</span>
				<span class="sr-only">Previous</span>
			</a>
		</li>
		@else	
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
				<span aria-hidden="true">«</span>
				<span class="sr-only">Previous</span>
			</a>
		</li>	
		@endif


		<!-- Pagination Elements -->
		@foreach ($elements as $element)
		<!-- "Three Dots" Separator -->
		@if (is_string($element))
		<li class="page-item disabled">
			<a class="page-link" href="#">{{ $element }}</a>
		</li>
		@endif

		<!-- Array Of Links -->
		@if (is_array($element))
		@foreach ($element as $page => $url)
		@if ($page == $paginator->currentPage())

		<li class="page-item disabled">
			<a class="page-link" href="#">{{ $page }}</a>
		</li>
		@else
		<li class="page-item">
			<a href="{{ $url }}" class="page-link" >{{ $page }}</a>
		</li>
		@endif
		@endforeach
		@endif
		@endforeach


		<!-- Next Page Link -->
		@if ($paginator->hasMorePages())
		<li class="page-item">
			<a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
				<span aria-hidden="true">»</span>
				<span class="sr-only">Next</span>
			</a>
		</li>
		@else
		<li class="page-item disabled">
			<a href="" class="disabled page-link">				
				<span aria-hidden="true">»</span>
				<span class="sr-only">Next</span>
			</a>
		</li>
		@endif
		
	</ul>
</nav>