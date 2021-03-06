# Component parameters

Components support different parameters depending on the component type. Refer to individual component documentation to see which parameters are supported. 

#### Documentation of the most commonly supported parameters that apply to most elements

`style` This is the most common parameter and defines the style class name. All components support this, but not all style parameters might not be supported in some edge cases (video for example).

`onclick` Second most commonly used parameter, which defines an action upon click. All components support this. This can be either one onclick object obtained with any of the `$this->getOnclick` helpers or an array of several onclicks. When array is defined, client will execute commands in order they are defined in the array. IMPORTANT NOTE HERE: some onclicks return an array (most notably route when it has saveparameters), whereas most onclicks will return and object. 

`variable` Used by text, form elements and images. This helps client tie the data. For example, if you set a variable outside of the component, when variable is defined the value would get updated immediately. Common example case is where you have a clickable field which reveals a selector element that sets the value. 

NOTE: you can use either actual variable id's together with $this->getVariableId('name') or give them as strings. If the variable is defined for the app, the client would always send id instead of the string. All async functionalities require that the variable exists for the app and they need to be defined by id, NOT STRING.

`id` Id of the element. This is used when showing or hiding elements with onclick, by swipestack and swipe components. If you have multiple swipe components in the view with a swipe indicator, they must have id's defiend. If you only have one swipe element, the swipe navigation will default to that even without id.

#### Form field text component parameters

`hint` Shows a hint on the background of "field-text" or "field-textview" if the components have no content. Uses the form style with opacity set to 0.6.

`activation` Initially or keep-open. Initially means that the text field is in focus when opening the view, keep-open will keep the focus in the form field and keyboard open even when the view is submitted.

`submit_menu_id` Menuid to submit when submit_on_entry is defined. This is available for your model as $this->getMenuId();

`submit_on_entry` Submit view when text is edited in the field. This can be used to make suggestive search for example. Note that filter is often a better option as it doesn't require turnaround to the server.

`update_on_entry` Instructs the mobile client to update all linked components when the component value changes. Components are linked by setting the same "variable".

`filter_on_entry` It can be either 1 or 0. When this flag is set on a field-text components the mobile client will filter out all 1st level components that has "filter" set and "filter" does not contain the current text in the field-text component.

`input_type` phone, number, name, uppercase, lowercase, email

`autocorrect` Either 0 or 1. Default is 0,

`value` Initial value of the field.

`activation` Initially or keep-open. Initially means that the text field is in focus when opening the view, keep-open will keep the focus in the form field and keyboard open even when the view is submitted.

`maxlength` Max length of the field content. Number of characters, also whitespace is counted.

`disable_onclick_when_keypad_is_on` This will disable all clickable items as long as the keyboard is open.

#### Selectors (checkbox and radio button -like functionality)

Example of defining a select element:

```
    $selectstate_female = array('variable_value' => "male",'style' => 'selector_role_selected','allow_unselect' => 1,'animation' => 'fade');
    $selectstate_male = array('variable_value' => "female",'style' => 'selector_role_selected','allow_unselect' => 1,'animation' => 'fade');

    $col[] = $this->getText('{#female#}',array('variable' => 'gender','selected_state' => $selectstate_female,'style' => 'selector_role', 'active' => 1));
    $col[] = $this->getVerticalSpacer('10%');
    $col[] = $this->getText('{#male#}',array('variable' => 'gender','selected_state' => $selectstate_male,'style' => 'selector_role'));

    $this->data->footer[] = $this->getRow($col,array('margin' => '14 40 31 40','text-align' => 'center'));

```

`selected_state` Parameters for this compoenent when its selected
 
`allow_unselect` Whether the option can be unselected 

`animation` Fade or none 

`active` If the element is currently active 

`other_variables` An array with variable names. Its used when a component has "selected_state" and when selected it should also select all other components that has variable name that matches and item in this list

If the elements are using the same variable, it behaves like a radio button, if they have different variables, it acts as checkboxes.

#### Image component parameters
`image_fallback` when clicked, change to this image immediately

`lazy` can load after view, shows a loader

`tap_to_open` will open a full screen image when clicked

`tap_image` image asset name to be used on the full screen view

#### Map component parameters
Map component uses Google maps to display a map. Note that you need to define Google Maps API key in your app settings for this to work. Please refer to Google documentation: 

* https://developers.google.com/maps/documentation/ios-sdk/map
* https://developers.google.com/maps/documentation/ios-sdk/marker

`position` Lat, lon of the map position.

`zoom` Zoom level.

`map_type` roadmap, satellite, hybrid, terrain.

`markers` Array of map markers

#### Video component parameters
`autostart` Starts video when entering the view.

`showplayer` Shows player controls.

`loop` Loops the video.

#### Calendar component parameters
`date` Unix time

`date_format` For example MM / dd / yyyy

`show_only_current_month` Shows only the current month and won't allow navigating between months

`disable_swipe` Disables the swipe in the calendar component and replaces it with buttons

`selection_style` Style name

`weekend_style` Style name

`weekdays_style` Style name

`header_style` Style name

`today_style` Style name

#### Swipe component specific parameters

`remember_position` Remembers the position of the swiped page between refreshes and when navigating out from the action.

`hide_scrollbar` Hides bottom scroll bar

`topbar_title` Changes the action's top bar. This must be defined for the main level of the element which is inside the swipe.

`animation` nudge. If this is set, the swipe component will make a small nudge movment when entering the view. This will hint user that the content is swipable. 

#### Swipe naviagation parameters

`active_color` This is used to specify the color of the active dot in "swipe-navigation" component.
`inactive_color` This is used to specify the color of the inactive dots in "swipe-navigation" component

#### Swipestack component specific parameters

Swipe component is a very powerful component, which allows the actions to be recorded by the backend in an asynchronous manner. This provides seamless user experience when swiping items in the swipe stack. 

`leftswipeid` Menuid to call when swiping an element left. Menuid is available with $this->getMenuId();

`rightswipeid` Menuid to call when swiping an element right. Menuid is available with $this->getMenuId();

`upswipeid` Menuid to call when swiping an element up. Menuid is available with $this->getMenuId();

`downswipeid` Menuid to call when swiping an element down. Menuid is available with $this->getMenuId();

`prevswipeid` Is set when the item is swiped. Its automatically assigned by the server to either leftswipeid or rightswipeid depending on which direction the item was swiped.

`backswipeid` Menuid to call when returning an element back from the swipe_back_content.

`overlay_right` A component that will be rendered on top of the card that the user is swiping.

`overlay_left` A component that will be rendered on top of the card that the user is swiping.

`overlay_up` A component that will be rendered on top of the card that the user is swiping.

`overlay_down` A component that will be rendered on top of the card that the user is swiping.

`swipe_back_content` An array with components that the user can swipe back. When the user do "swipe-back" the first item from this array will be returned to the 'swipestack' component with an animation.

#### Used by swipe and scrolling content

Dynamic swipe component can call the server with following parameters on $_REQUEST:
`swid`
`world_ending`
`backwards`
`merge_before`

Component parameters:

`dynamic` Defines the element to be dynamically loading

`world_ending` Yes, really, don't ask about parameter naming. This is the menuid that gets called when we are near the cached content ending. This is a que for the backend to provide more items. 

`id` Id of the swipe container, needed for dynamic swipes

`item_scale` set this to 1 to have scaling effect when swiping

`transition` swipe

`preserve_position` preserve the swipe position between action refreshes

`initial_swipe_id` items need to have swipe_id defined in order to use this. Opens the swipestack on this page.

`item_width` width of the items

`remember_position` used by non-dynamic swipes. Remembers users position between action refreshes. 

`merge_data` If this is set to 1, client will merge the new data based on swipe_id's. This way the backend doesn't need to fetch the entire swipe stack, only new items.

Best example of the swipestack you can find from action Mcalendar. 

#### Advertising component parameters

`ad_size` Sizes are:
- 'banner' => '{%small%} (320x50)',
- 'large' => '{%large%} (320x100)',
- 'rectangle' => '{%box%} (300x250)',

`ad_id` required, ID as defined in the Google Ads console or AdColony


#### Slider component parameters

Remember to add `variable` for the slider. If you have also `variable2` defined, this will display a range slider. 

`min_value` Numeric. Minimum value to set.

`max_value` Numeric. Maximum value to set.

`step` Numeric. In what increments the slider moves.

`hide_tooltip` 1 or 0 whether the value is hidden when dragging the value

`tooltip_prefix` Prefix for the value. For example currency.

`tooltip_suffix` Suffix for the value. For example currency.

`track_height` Height of the slider itself, excluding thumbs.

`left_track_color` Hex. Color of the selected part. 

`right_track_color` Hex. Color of the unselected part.

`thumb_color` Color for the slider's handle.

`thumb_image` Use image instead of the default slider handle.

`thumb_height` Height for the slider's handle.

##### Applies only for range slider

`variable2` Variable where second slider from the range slider is saved.

`min_range` Numeric. Minimum range for range slider

`max_range` Numeric. Maximum range for range slider

#### Progress bar component parameters

`text_content` Text content shown inside the bar. Styling the text is done by giving style parameters for the element itself.

`progress_image` Use image instead of the color for the progress bar itself.

`progress_color` Hex. Color for the inactive part of the progess bar.

`track_image` Use image instead of color for the active part.

`track_color` Hex. Color for the active part of the progess bar.

#### Infinite scrolling content

`next_page_id` You can access this with $this->getNextPageId() in the model. Use this to retrieve paged results.

`lazy` Lazy loading of the content, where we reveal the next page even if all content might not be fully loaded yet.

`show_loader` Whether to show the loader when reaching the end of the current page.

#### Timer component

`timer_id` Id of the timer component. This needs to be defined, client uses this to keep track of the time on the client side.

`submit_menu_id` Menuid to call when countdown reaches zero

`mode` countdown. Count down instead of up. Default is to count up.