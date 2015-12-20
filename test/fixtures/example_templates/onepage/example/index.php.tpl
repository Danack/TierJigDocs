{* This template extends another template *}
{extends file="onepage/example/parent"}

{* The block replaces the one with the same name from the parent template *}
{block name='overriddenBlock'}
    This text is from the child block
{/block}

All text in a template that extends another template should be inside a block.
These lines are not output.