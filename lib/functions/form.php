<?php

function form_error($err) {
    if(!empty($err)) {
        return '<span class="form-error-text">'.$err.'</span>';
    }
}

function form_error_class($err) {
    if(!empty($err)) {
        return ' form-field-error ';
    }
}