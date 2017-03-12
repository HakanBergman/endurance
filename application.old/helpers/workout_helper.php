<?php

function parseWorkout($workouts, $class, $userid = false) {

    $CI = & get_instance();

    if (is_object($workouts)) {
        $workouts = array($workouts);
    }

    if ($class == 'template_workout_notes' || $class == 'day_workoutnotes') {
        foreach ($workouts as $key => $workout) {
            $workout->__class__ = $class;
            
            if ($class == 'template_workout_notes') {
                $workout->__string__ = "Övrigt";
                $workout->__comment__ = "";
            } else {
                $CI->load->model('workoutnote_model');
                $workoutdata = $CI->workoutnote_model->get($workout->workoutnote_id);
                $workout->__string__ = $workoutdata->title;
                $workout->__comment__ = $workoutdata->comment;
            }
            $workout->__userid__ = $userid;
            $workout->__color__ = "#858585";
            $workout->__duration__ = 0;
            

            if ($class == 'day_workoutnotes') {
                $CI->load->model('day_model');
                $day = $CI->day_model->get($workout->day_id);
                $workout->day = $day->day;
            }

            $workouts[$key] = $workout;
        }
    } else {

        foreach ($workouts as $key => $workout) {
            if (isset($workout->workout_id)) {
                $workoutdata = $CI->workout_model->get($workout->workout_id);

                if (count($workoutdata) !== 0) {
                    $workout->__class__ = $class;
                    if ($class == 'day_result') {
                        $day_result = $CI->day_result_model->get_by(array('workout_id' => $workout->workout_id));

                        //Om vila visa inte form
                        $CI->load->model('workout_parts_model');
                        $CI->load->model('part_model');
                        $workout_parts = $CI->workout_parts_model->get_many_by(array('workout_id' => $workout->workout_id));
                        $parts = array();
                        $noshape = false;
                        foreach ($workout_parts as $workout_part) {
                            $part = $CI->part_model->get($workout_part->part_id);
                            $part->title = $CI->part_model->toString($part);
                            if (strtolower($part->title) == 'vila') {
                                $noshape = true;
                            }
                        }
                        if ($noshape) {
                            $replace_str = array('"', "'", ",", "\n", "}", "{", "(", ")", "\\");
                            $workout->__string__ = str_replace($replace_str, " ", $workoutdata->title);
                            $workout->__string__ = htmlspecialchars($workout->__string__);
                        } else {
                            $replace_str = array('"', "'", ",", "\n", "}", "{", "(", ")", "\\");
                            $workout->__string__ = str_replace($replace_str, " ", $workoutdata->title);
                            $workout->__string__ = htmlspecialchars($workout->__string__);
                            $workout->__string__ .= ' (' . (-$day_result->shape + 4) . ')';
                        
                            
                        }
                    } else {
                        $replace_str = array('"', "'", ",", "\n", "}", "{", "(", ")", "\\");
                        $workout->__string__ = str_replace($replace_str, " ", $workoutdata->title);
                        $workout->__string__ = htmlspecialchars($workout->__string__);
                    }
                    if ($userid) {
                        $workout->__userid__ = $userid;
                    }
                    $workout->__color__ = $CI->template_workout_model->color($workout->workout_id);
                    $workout->__duration__ = $CI->template_workout_model->duration($workout->workout_id);
                    $workout->__userid__ = $userid;
                    $replace_str = array('"', "'", ",", "\n", "}", "{", "(", ")", "\\");
                    $workout->__comment__ = str_replace($replace_str, " ", $workoutdata->comment);
                    $workout->__comment__ = htmlspecialchars($workout->__comment__);

                    $workout->comment = str_replace($replace_str, " ", $workoutdata->comment);
                    $workout->comment = htmlspecialchars($workout->comment);

                    if ($class == 'day_workout' || $class == 'day_result') {
                        $CI->load->model('day_model');
                        $day = $CI->day_model->get($workout->day_id);
                        $workout->day = $day->day;
                    }


                    $workouts[$key] = $workout;
                } else {
                    unset($workouts[$key]);
                }
            }
        }
    }
    return json_encode($workouts);
}

function hasAccess($enddate, $date) {

    if (isset($enddate)) {
        $CI = & get_instance();
        $CI->load->library('PDate', array('date' => strtotime($enddate)), 'PDateEndDate');
        $enddate = $CI->PDateEndDate;

        $qdate = $date->year + $date->period + $date->week + $date->day;
        $qenddate = $enddate->year + $enddate->period + $enddate->week + $enddate->day;

        if ($date->time() < $enddate->time()) {
            $hasaccess = true;
        } else {
            $hasaccess = true;
        }
    } else {
        $hasaccess = true;
    }

    return $hasaccess;
}

