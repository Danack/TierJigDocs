This is before the block.

{block name='overriddenBlock'}
    This block is over-ridden by the block in the child template. This text, from the parent template, is not in the output.
{/block}

This is between the blocks

{block name='parentOnlyBlock'}
    This is block is not set in the template that extends the parent template. It has the content
    that was set in the parent block
{/block}


This is after the blocks.


