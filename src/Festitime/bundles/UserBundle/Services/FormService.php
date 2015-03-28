<?php

namespace Festitime\bundles\UserBundle\Services;

class FormService
{
    public function getAllFormErrors($form)
    {
        $errors = array();
        $child_errors = $form->getErrors();
        if (!empty($child_errors)) {
            foreach ($form->getErrors() as $error) {
                $errors[] = $error->getMessage();
            }
        }
        foreach ($form->all() as $child) {
            $errors = array_merge($this->getAllFormErrors($child), $errors);
        }

        return $errors;
    }
}
