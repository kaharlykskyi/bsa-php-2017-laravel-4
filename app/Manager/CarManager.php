<?php

namespace App\Manager;

use App\Entity\Car;
use App\Manager\Contract\CarManager as CarManagerContract;
use App\Request\Contract\SaveCarRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class CarManager implements CarManagerContract
{

    /**
     * Find all Cars
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return Car::all();
    }

    /**
     * Find Car by ID
     *
     * @param int $id
     * @return Car|null
     */
    public function findById(int $id)
    {
        return is_numeric($id) ? Car::find($id) : null;
    }

    /**
     * Find Cars that belongs only to active users
     *
     * @return Collection
     */
    public function findCarsFromActiveUsers(): Collection
    {
        $isActive = Car::whereHas('user', function ($query) {
            $query->where('is_active', true);
        });
        return $isActive->get();
    }

    /**
     * Create or Update Car
     *
     * @param SaveCarRequest $request
     * @return Car|null
     */
    public function saveCar(SaveCarRequest $request): Car
    {
        $car = $request->getCar();
        $car->model = $request->getModel();
        $car->registration_number = $request->getRegistrationNumber();
        $car->year = $request->getYear();
        $car->color = $request->getColor();
        $car->mileage = $request->getMileage();
        $car->price = $request->getPrice();
        $car->user_id = $request->getUser()->id;

        return $car->save() ? $car : null;
    }

    /**
     * Delete car by ID.
     *
     * @param int $carId
     * @throws ModelNotFoundException
     * @return string
     */
    public function deleteCar(int $carId)
    {
        if (is_numeric($carId)) {
            try {
                $car = Car::findOrFail($carId);
                $car->delete();
            } catch (ModelNotFoundException $e) {
                return "Error: {$e->getMessage()}";
            }
        }
    }
}