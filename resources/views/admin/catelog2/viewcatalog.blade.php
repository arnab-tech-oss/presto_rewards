<div class= "card card_content mb-0">
    @if ($viewcatalog && pathinfo($viewcatalog->image, PATHINFO_EXTENSION) === 'pdf')
        <iframe src="{{ asset($viewcatalog->image) }}" width="100%" height="600px">
            This browser does not support PDFs. Please download the PDF to view it:
            <a href="{{ asset($viewcatalog->image) }}">Download PDF</a>
        </iframe>
    @else
        <img src="{{ asset($viewcatalog->image) }}" alt="Catalog Image" class="img-fluid">
    @endif
</div>
