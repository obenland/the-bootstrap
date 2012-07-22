## Bootstrap shortcodes

Shortcodes for specific Bootstrap UI Scaffolding and Components are included.


 * See: (http://twitter.github.com/bootstrap/scaffolding.html)
 * See: (http://twitter.github.com/bootstrap/components.html)

### Nesting columns

Use `[one_half]`, `[one_third]`, `[two_thirds]`, `[one_fourth]` & `[three_fourth]` to generate nested columns.

 - Attribute `first` is required for first column
 - Attribute `last` is required for last column
 - _Opptional_ attribute `class="yourownclass"` allows one to set div css class

E.g.
	`[one_fourth first]

	Content narrow left

	[/one_fourth]
	[one_half]

	Content for wide middle

	[/one_half]
	[one_fourth last]

	Content narrow right

	[/one_fourth]`


### Responsive visibility

Use `[hide]` & `[show]` for showing and hiding content by device.

 - Attribute `on="device"` sets devise visability, where _device_ is one of; `phone`, `tablet`, `desktop`, `all` or `none`

E.g.
	`[show on="tablet"]

	This content will only display on a tablet

	[\show]`
