"use client";

import react, { useState, useEffect } from "react";
import Image from "next/image";

export default function Home() {
  const [loading, setLoading] = useState(false);
  const [faculty, setFaculty] = useState([]);
  const [program, setProgram] = useState([]);
  const [student, setStudent] = useState([]);
  const [vaccine, setVaccine] = useState([]);
  const [vaccineRecord, setVaccineRecord] = useState([]);

  const nextRegister = () => {
    window.location.href = '/register';
  }


  if (loading) {
    return (
      <h1
        style={{ display: "flex", fontSize: "100px", justifyContent: "center" }}
      >
        Loading...
      </h1>
    );
  }

  const handleFaculty = async () => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/faculty");
      const data = await response.json();
      setFaculty(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  const handleProgram = async () => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/program");
      const data = await response.json();
      setProgram(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  const handleStudent = async () => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/student");
      const data = await response.json();
      setStudent(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  const handleVaccine = async () => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/vaccine");
      const data = await response.json();
      setVaccine(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };
  const handleVaccineRecord = async () => {
    setLoading(true);
    try {
      const response = await fetch("http://127.0.0.1:8000/api/vaccinerecord");
      const data = await response.json();
      setVaccineRecord(data);
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <main className="flex min-h-screen flex-col items-center justify-between p-24">
      <div>
      <h1 style={{ fontSize: "40px" }}>All data</h1>
      <button onClick={nextRegister} className="btn-primary">Register to Manage data</button>
      </div>
      <div className="flex">
        <div style={{ margin: "0 1rem" }}>
          <h1 style={{ fontSize: "30px" }}>
            Faculty
            <button
              onClick={handleFaculty}
              className="ml-3 text-lg mb-2 btn btn-primary"
            >
              Show
            </button>
          </h1>
          <div className="bg-gray-200">
            {loading ? loading : ""}
            <table class="table-auto">
              <thead>
                <tr>
                  <th>faculty_th</th>
                  <th>faculty_en</th>
                </tr>
              </thead>
              <tbody>
                {faculty
                  ? faculty.map((val, key) => (
                      <tr key={key}>
                        <td>{val.faculty_th}</td>
                        <td>{val.faculty_en}</td>
                      </tr>
                    ))
                  : ""}
              </tbody>
            </table>
          </div>
        </div>

        <div style={{ margin: "0 1rem" }}>
          <h1 style={{ fontSize: "30px" }}>
            Program{" "}
            <button onClick={handleProgram} className="ml-3 text-lg mb-2 btn btn-primary">Show</button>
          </h1>
          <div className="bg-gray-200">
          {loading ? loading : ""}
            <table class="table-auto">
              <thead>
                <tr>
                  <th>faculty_th</th>
                  <th>faculty_en</th>
                  <th>grad_year</th>
                </tr>
              </thead>
              <tbody>
                {program
                  ? program.map((val, key) => (
                      <tr key={key}>
                        <td>{val.program_th}</td>
                        <td>{val.program_en}</td>
                        <td>{val.grad_year}</td>
                      </tr>
                    ))
                  : ""}
              </tbody>
            </table>
          </div>
        </div>

        <div style={{ margin: "0 1rem" }}>
          <h1 style={{ fontSize: "30px" }}>
            Student{" "}
            <button onClick={handleStudent} className="ml-3 text-lg mb-2 btn btn-primary">Show</button>
          </h1>
          <div className="bg-gray-200">
          {loading ? loading : ""}
            <table class="table-auto">
              <thead>
                <tr>
                  <th>SID</th>
                  <th>First name</th>
                  <th>Last name</th>
                </tr>
              </thead>
              <tbody>
                {student
                  ? student.map((val, key) => (
                      <tr key={key}>
                        <td>{val.sid}</td>
                        <td>{val.fname}</td>
                        <td>{val.lname}</td>
                      </tr>
                    ))
                  : ""}
              </tbody>
            </table>
          </div>
        </div>

        <div style={{ margin: "0 1rem" }}>
          <h1 style={{ fontSize: "30px" }}>
            Vaccine{" "}
            <button onClick={handleVaccine} className="ml-3 text-lg mb-2 btn btn-primary">Show</button>
          </h1>
          <div className="bg-gray-200">
          {loading ? loading : ""}
            <table class="table-auto">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Vaccine</th>
                </tr>
              </thead>
              <tbody>
                {vaccine
                  ? vaccine.map((val, key) => (
                      <tr key={key}>
                        <td>{val.id}</td>
                        <td>{val.vaccine}</td>
                      </tr>
                    ))
                  : ""}
              </tbody>
            </table>
          </div>
        </div>

        <div style={{ margin: "0 1rem" }}>
          <h1 style={{ fontSize: "30px" }}>
            Vaccine Record{" "}
            <button onClick={handleVaccineRecord} className="ml-3 text-lg mb-2 btn btn-primary">Show</button>
          </h1>
          <div className="bg-gray-200">
          {loading ? loading : ""}
            <table class="table-auto">
              <thead>
                <tr>
                  <th>STD_ID</th>
                  <th>VAC_ID</th>
                  <th>Vaccined_date</th>
                </tr>
              </thead>
              <tbody>
                {vaccineRecord
                  ? vaccineRecord.map((val, key) => (
                      <tr key={key}>
                        <td>{val.std_id}</td>
                        <td>{val.vac_id}</td>
                        <td>{val.vaccined_date}</td>
                      </tr>
                    ))
                  : ""}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  );
}
