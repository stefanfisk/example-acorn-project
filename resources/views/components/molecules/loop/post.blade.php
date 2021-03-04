<x-molecules.card
    :image="get_post_thumbnail_id()"
    :title="html(get_the_title())"
    :text="get_the_excerpt()"
    :link="get_permalink()"
/>
