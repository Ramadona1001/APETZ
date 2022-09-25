<div>
    <input type="search"  class="form-control" placeholder="Search" wire:model="searchCourse" />
    @if ($searchCourse != '')
    <ul style="list-style: none; background: #ececec; color: #4b8df8; font-weight: bold; padding: 10px; border-bottom: 5px solid #e0e0e0;">
        @foreach ($results as $result)
            <li>
                <a href="{{ route('website_course',getDataFromJsonByLanguage($result->slug)) }}">{{ getDataFromJsonByLanguage($result->title) }}</a>
            </li>
        @endforeach
    </ul>
    @endif
</div>
