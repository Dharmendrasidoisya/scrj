<div
    @if(! $width && ! $height)
        style="position: relative; display: block; height: 0; padding-bottom: 56.25%; overflow: hidden;"
    @else
        style="margin-bottom: 20px;"
    @endif
>
        <iframe
            src="https://maps.google.com/maps?q={{ addslashes($address) }}%20&t=&z=13&ie=UTF8&iwloc=&output=embed"
            @if(! $width && ! $height)
                style="position: absolute; top: 0; bottom: 0; left: 0; width: 100%; height: 100%; border: 0;"
            @endif
            @if ($height)
                height="{{ $height }}"
            @endif

            @if ($width)
                width="{{ $width }}"
            @endif

            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
        ></iframe>

{{-- 
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4556.051190956635!2d72.50749937603675!3d23.037972715751874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9ba96399610b%3A0x8bb87add6357efe9!2sDholera%20Nirman%20Group%20-%20Dholera%20Smart%20City%20%7C%20Best%20Residential%20PLOT%20in%20Dholera%20Gujarat%20%7C%20Plots%20in%20Dholera%20%7C%20Dholera%20Smart%20City!5e1!3m2!1sen!2sin!4v1745488950992!5m2!1sen!2sin" width="2000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
</div>
