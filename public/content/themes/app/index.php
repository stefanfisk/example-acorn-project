<?php

use function Roots\app;
use function Roots\view;

echo view(app('templateLoader')->view);
