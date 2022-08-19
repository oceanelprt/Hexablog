<?php

namespace Domain\Blog\Exception;

use Exception;

// Le final fait qu'on ne peut pas hériter de cette classe
final class InvalidPostDataException extends Exception {

}