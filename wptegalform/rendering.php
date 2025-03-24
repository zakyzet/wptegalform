<?php
    public static function convertSpacesToHyphens($string) {
        // Replace spaces with hyphens
        $result = str_replace(' ', '-', $string);

        // Remove any consecutive hyphens
        $result = preg_replace('/-+/', '-', $result);

        // Trim hyphens from the beginning and end of the string
        $result = trim($result, '-');

        return $result;
    }

    public static function convertHyphensToSpaces($string) {
        // Replace hyphens with spaces
        $result = str_replace('-', ' ', $string);

        return $result;
    }

    public static function renderFormBuilderHTML($formBuilderJSON) {
    $elements = json_decode($formBuilderJSON, true);
	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // Check if decoding was successful and $elements is an array
    if (!is_array($elements)) {
        return 'Invalid JSON format.';
    }

    $html = '<form id="superpform" method="post" action=""> ';


    // foreach ($elements as $element) {
    //     if (!is_array($element) || !isset($element['type'])) {
    //         continue;
    //     }

    //     // Start form group
    //     $html .= '<div class="form-group">';

    //     // Check if 'name' key is set
    //     $name = isset($element['label']) ? superpform::convertSpacesToHyphens($element['label']) : '';
    //     $label = isset($element['label']) ? $element['label'] : '';

    //     // Label (skip for header and paragraph)
    //     if ($element['type'] !== 'header' && $element['type'] !== 'paragraph') {
    //         $html .= '<label for="' . $label . '">' . $label . ':</label>';
    //     }

    //     switch ($element['type']) {
    //         case 'header':
    //             $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
    //             break;
    //         case 'paragraph':
    //             $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
    //             break;
    //         case 'checkbox-group':
    //             foreach ($element['values'] as $value) {
    //             /*
    //                 <div class="checkbox">
    //                 <label>
    //                     <input type="checkbox" id="otherOption"> Other
    //                 </label>
    //                 <input type="text" id="otherOptionText" class="form-control" placeholder="Please specify" style="display: none;">
    //                 </div>
    //             */
    //                 $html .= '<div class="checkbox">';
    //                 $html .= '<label class="form-check-label" for="' . $name . '-' . $value['value'] . '"><input class="form-check-input" type="checkbox" name="' . $name . '[]" value="' . $value['label'] . '" id="' . $name . '-' . $value['label'] . '">' . $value['label'] . '</label>';
    //                 $html .= '</div>';
    //             }
    //             if ($element['other'] === true) {
    //                 $html .= '<div class="checkbox">';
    //                 $html .= '<label class="form-check-label"><input class="form-check-input" type="checkbox" id="otherOption"> Other</label>';
    //                 $html .= '<input type="text" id="otherOptionText" class="form-control" placeholder="Please specify" style="display: none;">';
    //                 $html .= '</div>';
    //             }
    //             if (!empty($element['description'])) {
    //                 $html .= '<p class="help-block">' . $element['description'] . '</p>';
    //             }
    //             break;
    //         case 'date':
    //             $html .= '<input class="' . $element['className'] . '" type="date" name="' . $name . '" id="' . $name . '">';
    //             break;
    //         case 'number':
    //             $html .= '<input class="' . $element['className'] . '" type="number" name="' . $name . '" id="' . $name . '">';
    //             break;
    //         case 'radio-group':
    //             foreach ($element['values'] as $value) {
    //                 $html .= '<div class="form-check">';
    //                 $html .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value['value'] . '" id="' . $name . '-' . $value['value'] . '">';
    //                 $html .= '<label class="form-check-label" for="' . $name . '-' . $value['value'] . '">' . $value['label'] . '</label>';
    //                 $html .= '</div>';
    //             }
    //             break;
    //         case 'select':
    //             $html .= '<select class="' . $element['className'] . '" name="' . $name . '" id="' . $name . '">';
    //             foreach ($element['values'] as $value) {
    //                 $html .= '<option value="' . $value['value'] . '" ' . ($value['selected'] ? 'selected' : '') . '>' . $value['label'] . '</option>';
    //             }
    //             $html .= '</select>';
    //             break;
    //         case 'text':
    //             $html .= '<input type="text" name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '">';
    //             break;
    //         case 'textarea':
    //             $html .= '<textarea name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '"></textarea>';
    //             break;
    //         // Add more cases for other form elements as needed
    //         default:
    //             // Handle unknown form element types
    //             break;
    //     }

    //     // End form group
    //     $html .= '</div>';
    // }



    foreach ($elements as $element) {
        if (!is_array($element) || !isset($element['type'])) {
            continue;
        }

        // Start form group
        $html .= '<div class="form-group">';

        // Check if 'name' key is set
        $name = isset($element['label']) ? superpform::convertSpacesToHyphens($element['label']) : '';
        $label = isset($element['label']) ? $element['label'] : '';

        // Label (skip for header and paragraph)
        if ($element['type'] !== 'header' && $element['type'] !== 'paragraph') {
            $html .= '<label for="' . $label . '">' . $label;
            if ($element['required']) {
                $html .= '<span class="required">*</span>'; // Add a required indicator
            }
            $html .= ':</label>';
        }

        switch ($element['type']) {
            case 'header':
                $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
                break;
            case 'paragraph':
                $html .= '<' . $element['subtype'] . '>' . $label . '</' . $element['subtype'] . '>';
                break;
            case 'checkbox-group':
                foreach ($element['values'] as $value) {
                    $html .= '<div class="checkbox testaja">';
                    $html .= '<div class="text"><input class="form-check-input" type="checkbox" name="' . $name . '[]" value="' . $value['label'] . '" id="' . $name . '-' . $value['label'] . '"';
                    if ($element['required']) {
                        $html .= ' required';
                    }
                    $html .= '> </div>';
                    $html .= '<label class="form-check-label" for="' . $name . '-' . $value['value'] . '">' . $value['label'] . '</label>';
                    $html .= '</div>';
                }
                if ($element['other'] === true) {
                    $html .= '<div class="checkbox">';
                    $html .= '<label class="form-check-label"><input class="form-check-input" type="checkbox" id="otherOption"> Other</label>';
                    $html .= '<input type="text" id="otherOptionText" class="form-control" placeholder="Please specify" style="display: none;">';
                    $html .= '</div>';
                }
                // if (!empty($element['description'])) {
                    // $html .= '<p class="help-block">' . $element['description'] . '</p>';
                // }
                break;
            case 'date':
                $html .= '<input class="' . $element['className'] . '" type="date" name="' . $name . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                $html .= '>';
                break;
            case 'number':
                $html .= '<input class="' . $element['className'] . '" type="number" name="' . $name . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                $html .= '>';
                break;
            case 'radio-group':
                foreach ($element['values'] as $value) {
                    $html .= '<div class="form-check">';
                    $html .= '<input class="form-check-input" type="radio" name="' . $name . '" value="' . $value['value'] . '" id="' . $name . '-' . $value['value'] . '"';
                    if ($element['required']) {
                        $html .= ' required';
                    }
                    $html .= '>';
                    $html .= '<label class="form-check-label" for="' . $name . '-' . $value['value'] . '">' . $value['label'] . '</label>';
                    $html .= '</div>';
                }
                break;
            case 'select':
                $html .= '<select class="' . $element['className'] . '" name="' . $name . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required ';
                }
                if ($element['multiple']) {
                    $html .= ' multiple ';
                }
                $html .= '>';
                foreach ($element['values'] as $value) {
                    $html .= '<option value="' . $value['value'] . '" ' . ($value['selected'] ? 'selected' : '') . '>' . $value['label'] . '</option>';
                }
                $html .= '</select>';
                break;
            case 'text':
                $html .= '<input type="text" name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                $html .= '>';
                break;
            case 'textarea':
                $html .= '<textarea name="' . $name . '" class="' . $element['className'] . '" id="' . $name . '"';
                if ($element['required']) {
                    $html .= ' required';
                }
                $html .= '></textarea>';
                break;
            // Add more cases for other form elements as needed
            default:
                // Handle unknown form element types
                break;
        }

        // End form group
        $html .= '</div>';
    }


    $html .= '<div class="form-group text-right"><button type="submit" id="send-message" class="btn-success btn">Submit</button></div>';
    $html .= '</form>';

    return $html;
    }