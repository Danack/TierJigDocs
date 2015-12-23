{extends file="syntax/extending/parentTemplate"}

{block name='overriddenBlock'}
    This block is set in the child template that extends the parent template.
{/block}

Any text outside of blocks in a child template is discarded.